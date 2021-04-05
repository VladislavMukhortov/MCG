<?php


namespace App\Services;

use App\Models\Attachments;
use App\Models\Question;
use App\Models\RemarkFile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionService
{
    /**
     * Store question
     *
     * @param array $data
     * @return bool
     */

    public static function createQuestion(array $data): bool
    {
        $data['author_id'] = auth('api')->user();

        if (Question::create($data)) {
            return true;
        }

        return false;
    }

    /**
     * Store question
     *
     * @param int $id
     * @param Request $request
     * @return int
     */

    public static function createAttachment(int $id, Request $request): int
    {
        $requestData = $request->all();
        $request['file'] = FileService::storeFile($request);
        $request['question_id'] = $id;

        $attachment = Question::find($id)->attachments()->create($requestData);

        return $attachment->id;
    }

    /**
     * Store question
     *
     * @param int $id
     * @return bool
     */

    public static function deleteAttachment(int $id): bool
    {
        $attachment = Attachments::fend($id);
        FileService::deleteFile($attachment->file);

        if ($attachment->delete()) {
            return true;
        }

        return false;
    }

    /**
     * Store remark for question
     *
     * @param int $id
     * @param Request $request
     * @return int
     */

    public static function storeRemark(int $id, Request $request): int
    {
        $requestData = $request->all();

        $requestData['user_id'] = auth('api')->user();
        $requestData['question_id'] = $id;
        $requestData['file_path'] = FileService::storeFile($request);

        $remark = Question::find($id)->remarks()->create($requestData);

        return $remark->id;
    }

    /**
     * Delete remark from question
     *
     * @param int $id
     * @return bool
     */

    public static function deleteRemark(int $id): bool
    {
        $remark = RemarkFile::find($id);
        FileService::deleteFile($remark->file_path);

        if ($remark->delete()) {
            return true;
        }

        return false;
    }

    /**
     * Store remark for question
     *
     * @param int $id
     * @param int $status
     * @return bool
     */
    public static function changeStatus(int $id, int $status): bool
    {
        if (Question::find($id)->update([
            'status_id' => $status,
        ])) {
            return true;
        }

        return false;
    }

    /**
     * Delete question
     *
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool
    {
        if ($question = Question::find($id)) {
            $question->remarks()->delete();
            $question->attachments()->delete();
            $question->delete();

            return true;
        }

        return false;
    }
}