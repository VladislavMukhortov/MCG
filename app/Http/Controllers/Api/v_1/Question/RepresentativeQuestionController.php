<?php

namespace App\Http\Controllers\Api\v_1\Question;

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

    /**
     * Display representative questions
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //$this->authorize('')

        $questions = $this->questionRepository->all();

        return response()->json([
            'success' => true,
            'data' => [
                'questions' => $questions
            ]
        ], 200);

    }

    /**
     * Display representive question
     *
     * @param Question $question
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Question $question, Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'question' => $question
            ]
        ], 200);
    }
}
