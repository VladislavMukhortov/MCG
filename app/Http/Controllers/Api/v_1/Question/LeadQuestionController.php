<?php

namespace App\Http\Controllers\Api\v_1\Question;

use App\Http\Controllers\Controller;
use App\Http\Traits\Authorizable;
use App\Models\Question;
use App\Repositories\QuestionRepositoryEloquent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class LeadQuestionController extends Controller
{
    use Authorizable, AuthorizesRequests;
    protected $questionRepository;

    public function __construct(QuestionRepositoryEloquent $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * Lead questions list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewLead', (new Question()));

        $questions = $this->questionRepository->getLeadQuestions($request->user()->lead);

        return response()->json([
            'success' => true,
            'data' => [
                'questions' => $questions,
            ],
        ], 200);

    }

    /**
     * Display lead question by ID
     *
     * @param Question $question
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Question $question, Request $request)
    {
        $this->authorize('isOwnLead', $question);

        return response()->json([
            'success' => true,
            'data' => [
                'question' => $question,
            ],
        ], 200);
    }
}
