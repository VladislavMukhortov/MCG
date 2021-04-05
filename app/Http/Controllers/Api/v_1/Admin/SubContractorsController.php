<?php

namespace App\Http\Controllers\Api\v_1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Notes;
use App\Models\SubContractors;
use App\Services\SubcontractorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;


class SubContractorsController extends Controller
{

    /**
     * Get all subcontractors
     *
     * @return JsonResponse
     */

    public function getAllSubcontractors(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'allSubcontractors' => SubContractors::paginate(30),
            ],
        ]);
    }

    /**
     * Get subcontractors has project
     *
     * @return JsonResponse
     */

    public function getInProjectSubcontractors(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'inProjectSubcontractors' => SubContractors::where('has_project', '!=', null)->paginate(30),
            ],
        ]);
    }

    /**
     * Get subcontractors without project
     *
     * @return JsonResponse
     */

    public function getWithoutProjectSubcontractors(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'withoutProjectSubcontractors' => SubContractors::where('has_project', null)->paginate(30),
            ],
        ]);
    }

    //todo Возможно функция не будет нужна (с) Влад
    public function getVendors()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'vendors' => [],//$this->repository->getVendorslist(),
            ],
        ], 200);
    }

    /**
     * Create new subcontractor (demo variant)
     *
     * @param Request $request
     * @return JsonResponse
     */

    //todo Пока что просто сохранение из формы создания, потом будет большая форма и оттуда будет создание, скорее всего в сервисе
    public function store(Request $request): JsonResponse
    {
        if ($subcontractor = SubContractors::create($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.subContractors.create.success'),
                ],
                'data' => [
                    'subContractorId' => $request->id,
                ],
            ], 200);
        }
    }

    /**
     * Get subcontractor by id
     *
     * @param int $id
     * @return JsonResponse
     */

    public function show(int $id): JsonResponse
    {
        if ($subcontractor = SubContractors::find($id)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'subcontractorId' => $subcontractor,
                ],
            ]);
        }
    }

    /**
     * Get subcontractor's notes
     *
     * @param int $subcontractorId
     * @return JsonResponse
     */

    public function getNotesList(int $subcontractorId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'notes' => SubContractors::with('notes')->find($subcontractorId)->notes,
            ],
        ], 200);
    }

    /**
     * add new note for subcontractor
     *
     * @param Request $request
     * @param int $subcontractorId
     * @return JsonResponse
     */

    public function addNote(Request $request, int $subcontractorId): JsonResponse
    {
        if ($noteId = SubcontractorService::createNote($request, $subcontractorId)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.subContractors.create.success'),
                ],
                'data' => [
                    'noteId' => $noteId,
                ],
            ], 200);
        }
    }

    /**
     * Delete note for subcontractor
     *
     * @param int $noteId
     * @return JsonResponse
     */

    public function deleteNote(int $noteId): JsonResponse
    {
        if (Notes::find($noteId)->delete()) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.subContractors.create.success'),
                ],
            ], 200);
        }
    }

    /**
     * Get all subcontractor's attachments
     *
     * @param int $subcontractorId
     * @return JsonResponse
     */

    public function getAttachmentList(int $subcontractorId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.subContractors.create.success'),
            ],
            'data' => [
                'attachmentList' => SubContractors::with('attachments')->find($subcontractorId)->attachments,
            ],
        ], 200);
    }

    /**
     * Add subcontractor's attachment
     *
     * @param int $subcontractorId
     * @param Request $request
     * @return JsonResponse
     */

    public function addAttachment(Request $request, int $subcontractorId): JsonResponse
    {
        $attachmentId = SubcontractorService::createAttachment($request, $subcontractorId);
        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.subContractors.create.success'),
            ],
            'data' => [
                'attachmentId' => $attachmentId,
            ],
        ], 200);
    }

    /**
     * Delete subcontractor's attachment
     *
     * @param int $attachmentId
     * @return JsonResponse
     */

    public function deleteAttachment(int $attachmentId): JsonResponse
    {
        if (SubcontractorService::deleteAttachment($attachmentId)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.subContractors.create.success'),
                ],
            ], 200);
        }
    }

    /**
     * Get subcontractor's contacts
     *
     * @param int $subcontractorId
     * @return JsonResponse
     */

    public function getContactList(int $subcontractorId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'notes' => SubContractors::with('contacts')->find($subcontractorId)->contacts,
            ],
        ], 200);
    }

    /**
     * Add contact for subcontractor
     *
     * @param int $subcontractorId
     * @return JsonResponse
     */

    public function addContact(int $subcontractorId): JsonResponse
    {
        if (SubcontractorService::addContact($subcontractorId)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.subContractors.create.success'),
                ],
            ], 200);
        }
    }

    /**
     * remove contact from subcontractor
     *
     * @param int $contactId
     * @return JsonResponse
     */

    public function removeContact(int $contactId): JsonResponse
    {
        if (Contact::find($contactId)->update(['subcontractor' => null])) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.subContractors.create.success'),
                ],
            ], 200);
        }
    }

    /**
     * Update subcontractor
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */

    public function update(Request $request, int $id)
    {
       if (SubContractors::find($id)->update($request->all())) {
           return response()->json([
               'success' => true,
               'messages' => [
                   __('pages.subContractors.update.success'),
               ],
           ], 200);
       }

    }

    /**
     * Delete subcontractor
     *
     * @param int $id
     * @return JsonResponse
     */

    public function destroy(int $id)
    {
        if (SubContractors::find($id)->delete()) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.subContractors.delete.success'),
                ],
            ], 200);
        }
    }

    public function changeSubcontractorStatus()
    {
        
    }
}
