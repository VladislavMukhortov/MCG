<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentRequest;
use App\Http\Requests\Question\QuestionRequest;
use App\Http\Traits\Responseable;
use App\Models\Question;
use App\Models\QuestionStatus;
use App\Models\Remark;
use App\Models\RemarkFile;
use App\Repositories\QuestionRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    use Responseable;

    protected $representativeController;
    protected $questionRepository;
    protected $leadController;

    public function __construct(QuestionRepositoryEloquent $questionRepository,
                                LeadQuestionController $leadQuestionController,
                                RepresentativeQuestionController $representativeController)
    {
        $this->representativeController = $representativeController;
        $this->leadController           = $leadQuestionController;
        $this->questionRepository       = $questionRepository;
    }

    public function index(Request $request)
    {

        $this->authorize('viewAny', new Question);

        if ($request->user()->is_manager || $request->user()->is_admin) {
            $questions = $this->questionRepository->all();

            return view('Question.index', compact('questions'));
        }

        if ($request->user()->is_representative) return $this->representativeController->index($request);

        if ($request->user()->is_lead) {
            return $this->leadController->index($request);
        }

        return abort(404);
    }

    public function show(Question $question, Request $request)
    {
        if ($request->user()->is_manager || $request->user()->is_admin) {
            $this->authorize('view', $question);
            $path  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

            return view('Question.show', compact('question', 'path'));
        }

        if ($request->user()->is_representative) return $this->representativeController->show($question, $request);
        if ($request->user()->is_lead) {
            return  $this->leadController->show($question, $request);
        }

        return  abort(404);
    }

    public function store(Request $request) //todo QuestionRequest
    {
        //todo policy
        $this->questionRepository->create($request->all());

        return redirect()->back();
    }

    public function storeAttachment(Question $question, AttachmentRequest $request)
    {
        $this->authorize('update', $question);

        $this->questionRepository->storeAttachment($question, $request->file('file'), collect($request->only(['user_id', 'description'])));

        return redirect()->route('questions.show', $question);
    }

    public function storeRemark(Question $question, Request $request) //todo QuestionRemarkRequest
    {
        $data = collect($request->only(['description']))->merge(['user_id' => $request->user()->id]);
        $this->questionRepository->storeRemark($question, $data);

        return redirect()->route('questions.show', $question);
    }

    public function destroyRemark(Question $question, Remark $remark)
    {
        $this->authorize('delete', $remark);
        $this->questionRepository->destroyRemark($remark); //todo RemarkRepository

        return redirect()->route('questions.show', $question);

    }


    public function destroyAttachment(Question $question, RemarkFile $attachment)
    {
        $this->authorize('delete', $attachment);
        $this->questionRepository->destroyAttachment($attachment);  //todo RemarkFileRepository

        return redirect()->route('questions.show', $question);
    }

    /**
     * @param QuestionRequest $request
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $this->authorize('update', $question);

        $this->questionRepository->update($request->validated(), $question->id);

        return redirect()->route('questions.show', $question);
    }


    public function updateStatusToClosed(Question $question, Request $request)
    {
        $this->authorize('changeStatus', $question);

        $question = $this->questionRepository->updateStatus($question, collect(['status_id' => QuestionStatus::STATUS_CLOSED]));

        return $this->success(['statusTitle' => $question->status_title, 'status_id' => $question->status_id]);
    }

    public function updateStatusToInProgress(Question $question, Request $request)
    {
        $this->authorize('changeStatus', $question);

        $question = $this->questionRepository->updateStatus($question, collect(['status_id' => QuestionStatus::STATUS_IN_PROGRESS]));

        return $this->success(['statusTitle' => $question->status_title, 'status_id' => $question->status_id]);
    }

}
