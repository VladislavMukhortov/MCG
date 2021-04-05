<?php

namespace App\Http\Controllers\Question;

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

    public function index(Request $request)
    {
        $this->authorize('viewLead', (new Question()));

        $questions = $this->questionRepository->getLeadQuestions($request->user()->lead);

        return view('Question.leads.index', compact('questions'));
    }

    public function show(Question $question, Request $request)
    {
        $this->authorize('isOwnLead', $question);

        return view('Question.leads.show', compact('question'));
    }
}
