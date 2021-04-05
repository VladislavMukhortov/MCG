<?php

namespace App\Http\Controllers\Attachments;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentEmailRequest;
use App\Models\AttachmentLink;
use App\Repositories\AttachmentsRepositoryEloquent;
use Illuminate\Http\Request;

class AttachmentEmail extends Controller
{

    /**
     * @param $id
     * @param AttachmentEmailRequest $request
     * @param AttachmentsRepositoryEloquent $attachment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function attachmentCreate($id, AttachmentEmailRequest $request, AttachmentsRepositoryEloquent $attachment)
    {
        switch ($request->method()) {
            case 'POST':

                $attachment->addAttachments($id, $request);

                return view('attachments.attachment-success', ['success' => 'Files were submitted, thank you.']);

                break;

            case 'GET':

                $findLink = AttachmentLink::where('link', $id)->first();

                if ($findLink) {

                    return view('attachments.attachment', compact('id'));

                }
                break;



        }

    }

}
