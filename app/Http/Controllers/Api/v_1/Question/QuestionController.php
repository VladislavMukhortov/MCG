<?php

namespace App\Http\Controllers\Api\v_1\Question;

use App\Http\Controllers\Controller;
use App\Http\Traits\Responseable;
use App\Models\Question;
use App\Models\RemarkFile;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class QuestionController extends Controller
{
    use Responseable;

    /**
     * Get all questions
     *
     * @return JsonResponse
     */
    public function getAllQuestions(): JsonResponse
    {
            return response()->json([
                'success' => true,
                'data' => [
                    'questions' => Question::with('status')->paginate(30),
                ],
            ], 200);
    }

    /**
     * Get my questions
     *
     * @return JsonResponse
     */
    public function getMyQuestions(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'questions' => Question::where('author_id', auth('api')->user())->with('status')->paginate(30),
            ],
        ], 200);
    }

    /**
     * Get question by id
     *
     * @param int $id
     * @return JsonResponse
     */

    public function show(int $id):JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'question' => Question::with('status')->find($id),
            ],
        ], 200);
    }

    /**
     * Store question
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function store(Request $request): JsonResponse
    {
        if($questionId = QuestionService::createQuestion($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.questions.store.success')
                ]
            ], 200);
        }
    }

    /**
     * Store attachment for question
     *
     * @param int $questionId
     * @param Request $request
     * @return JsonResponse
     */

    public function storeAttachment(int $questionId, Request $request): JsonResponse
    {
        if ($attachmentId = QuestionService::createAttachment($questionId, $request)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.questions.attachment.store')
                ],
                'data' => [
                    'attachmentId' => $attachmentId,
                ],
            ], 200);
        }
    }

    /**
     * Get question's attachments
     *
     * @param int $questionId
     * @return JsonResponse
     */

    public function getAttachments(int $questionId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'questionAttachments' => Question::find($questionId)->attachments(),
            ]
        ], 200);
    }

    /**
     * Remove attachment of question
     *
     * @param int $attachmentId
     * @return JsonResponse
     */

    public function destroyAttachment(int $attachmentId): JsonResponse
    {
        if (QuestionService::deleteAttachment($attachmentId)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.questions.attachment.destroy')
                ],
            ], 200);
        }
    }

    /**
     * Store remark for question
     *
     * @param int $questionId
     * @param Request $request
     * @return JsonResponse
     */
    public function storeRemark(int $questionId, Request $request): JsonResponse
    {
        if ($remarkId = QuestionService::createRemark($questionId, $request)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.questions.remark.store')
                ],
                'data' => [
                    'remarkId' => $remarkId
                ]
            ], 200);
        }
    }

    /**
     * Get question's remarks
     *
     * @param int $questionId
     * @return JsonResponse
     */
    public function getRemarks(int $questionId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'questionRemarks' => Question::find($questionId)->remarks(),
            ],
        ], 200);
    }

    /**
     * Remove remark from question
     *
     * @param int $remarkId
     * @return JsonResponse
     */
    public function destroyRemark(int $remarkId): JsonResponse
    {
        if (QuestionService::deleteRemark($remarkId)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.questions.remark.store')
                ],
            ], 200);
        }
    }

    /**
     * Update question
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */

    public function update(Request $request, int $id): JsonResponse
    {
        if (Question::find($id)->update($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.questions.update.success')
                ],
            ], 200);
        }
    }

    /**
     * Remove question
     *
     * @param int $id
     * @return JsonResponse
     */

    public function destroy(int $id): JsonResponse
    {
        if (QuestionService::delete($id)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.questions.update.success')
                ],
            ], 200);
        }
    }

    /**
     * Change question's status
     *
     * @param int $questionId
     * @param Request $request
     * @return JsonResponse
     */

    public function changeStatus(int $questionId, Request $request): JsonResponse
    {
        if (QuestionService::changeStatus($questionId, $request->get('status'))) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.questions.status.success')
                ],
            ], 200);
        }
    }

}
