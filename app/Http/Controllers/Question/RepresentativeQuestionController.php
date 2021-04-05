<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Repositories\QuestionRepositoryEloquent;
use Illuminate\Http\Request;

class RepresentativeQuestionController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepositoryEloquent $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index(Request $request)
    {
        //$this->authorize('')

        $questions = $this->questionRepository->all();

        return view('Question.index', compact('questions'));
    }

    public function show(Question $question, Request $request)
    {
        //$this->authorize('')
        return view('Question.show', compact('question'));
    }
}
