<?php


namespace App\Services;


use App\Models\Attachments;
use App\Models\Notes;
use App\Models\SubContractors;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcontractorService
{
    /**
     * create new note for subcontractor
     *
     * @param Request $request
     * @param int $id
     * @return int
     */

    public static function createNote(Request $request, int $id): int
    {
        $subcontractor = SubContractors::find($id);
        $note = $subcontractor->notes()->create($request->all());

        return $note->id;
    }

    /**
     * create new note for subcontractor
     *
     * @param Request $request
     * @param int $id
     * @return int
     */

    public static function createAttachment(Request $request, int $id): int
    {
        $subcontractor = SubContractors::find($id);
        $requestData = $request->all();
        $requestData['file'] = FileService::storeFile($request);

        $attachment = $subcontractor->attachments()->create($request->all($requestData));

        return $attachment->id;
    }

    /**
     * create new note for subcontractor
     *
     * @param int $id
     * @return bool
     */

    public static function deleteAttachment(int $id): bool
    {
        $attachment = Attachments::find($id);
        FileService::deleteFile($attachment->file);

        return $attachment->delete();
    }

    /**
     * Add contact from contact list, for subcontractor
     *
     * @param int $id
     * @return bool
     */

    public static function addContact(int $id): bool
    {
        $subcontractor = SubContractors::find($id);
        $contact = $subcontractor->contacts()->update([
            'subcontractor' => $id,
        ]);

        if ($contact) {
            return true;
        }

        return false;
    }

}