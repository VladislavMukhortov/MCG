<?php

namespace App\Http\Controllers\Api\v_1\Attachments;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentEmailRequest;
use App\Models\AttachmentLink;
use App\Repositories\AttachmentsRepositoryEloquent;
use Illuminate\Http\Request;

class AttachmentEmail extends Controller
{

    public function attachmentCreate($id, AttachmentEmailRequest $request, AttachmentsRepositoryEloquent $attachment)
    {
        switch ($request->method()) {
            case 'POST':
                $attachment->addAttachments($id, $request);
                return response()->json([
                    'success' => true,
                    'messages' => [
                        __('pages.attachments.attachment_create.success'),
                    ],
                ], 200);
            case 'GET':
                $findLink = AttachmentLink::where('link', $id)->first();
                if ($findLink) {
                    return response()->json([
                        'success' => true,
                        'messages' => [
                            __('pages.attachments.attachment_create.success'),
                        ],
                        'data' => [
                            'id' => $id,
                        ],
                    ], 200);
                }
            break;
        }

    }

}
