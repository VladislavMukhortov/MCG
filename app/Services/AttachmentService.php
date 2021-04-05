<?php
/**
 * Created by PhpStorm.
 * User: RedEclipse
 * Date: 08.02.2021
 * Time: 13:46
 */

namespace App\Services;


use App\Mail\AttachmentLinkEmail;
use App\Models\AttachmentLink;
use App\Models\Attachments;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

class AttachmentService
{

    /**
     * Store file to the storage
     *
     * @param $request
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function store ($request)
    {

        $hash = Str::random(20);

        $route = '/storage/images';

        $type = $request['file']->getClientOriginalExtension();

        $allowedImageTypes = ['jpg', 'png', 'jpeg'];

        if (in_array($type, $allowedImageTypes)) {

            if(!File::isDirectory(public_path().$route)) {
                File::makeDirectory(public_path().$route, 0777, true);
            }

            $path = $route . "/" . $hash . ".jpg";

            Image::make($request['file'])->encode('jpg', 75)->save(public_path() . $path);

            return $path;

        } else {
            $t = $request->file('file')->store('files', 'public');
            return url('storage/'.$t);
        }

    }

    /**
     * Show attachment details by ID
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
       return Attachments::findOrFail($id)->select('id','file','attachment_description','status')->get();
    }

    public function update($id, $request)
    {
        if (Attachments::findOrFail($id)) {
            Attachments::find($id)->update($request);

            return $id;
        }
    }

    /**
     * Delete attachment in DB and if file found in storage it would be deleted as well
     *
     * @param $id
     */
    public function destroy($id)
    {
        $attachment = Attachments::findOrFail($id);

        $filePath = strstr($attachment->file, 'storage');

        if(File::exists($filePath)) {
            File::delete($filePath);
        }

        $attachment->delete();
    }

    /**
     * Send unique email link to request owner
     *
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendAttachmentLink ($request)
    {
        $values = $request->all();

        $user = User::find($values['user-id']);


        $hash = Str::random(10);

        AttachmentLink::create(['request_id' => $values['request'], 'user_id' => $values['user-id'], 'link' => $hash]);


        $data = ['name' => $user->name, 'email' => $user->email, 'subject' => 'Upload attachments for request', 'link' => $hash,];

        Mail::to($user->email)->send(new AttachmentLinkEmail($data));

        return redirect()->back()->with('email-success', 'Message sent.');


    }

    /**
     * Add attachments in unique link
     *
     * @param $id
     * @param $request
     */
    public function addAttachments ($id, $request)
    {

        $findLink = AttachmentLink::where('link', $id)->first();

        $files = $request->file('condition');
        // $files += $request->file('concept');
        // $files += $request->file('plane');


        foreach ($request->file() as $file) {

            $path = $file->store('attachments', 'public');

            $data = ['uploaded_by' => $findLink->user_id, 'file' => $path, 'request' => $findLink->request_id];

            $attachment = $this->Attachments->create($data);

        }

        AttachmentLink::where('link', $id)->delete();

    }

    /**
     * Generate attachments for initial form
     *
     * @param $request
     * @param $i
     * @param $leadId
     * @param $requestId
     */
    public function initialAttachments ($request, $i, $leadId, $requestId)
    {

        $pathRoomCondition = $request->file('roomcondition' . $i)->store('attachments', 'public');

        $attachmentRoomCondition = ['request' => $requestId, 'file' => $pathRoomCondition, 'uploaded_by' => $leadId];

        $this->Attachments->create($attachmentRoomCondition);


        $pathRoomInspiration = $request->file('roominspiration' . $i)->store('attachments', 'public');

        $attachmentInspiration = ['request' => $requestId, 'file' => $pathRoomInspiration, 'uploaded_by' => $leadId];

        $this->Attachments->create($attachmentInspiration);

        if (isset($request['floorplanfile'])) {
            $pathFloorplan = $request->file('floorplanfile')->store('attachments', 'public');

            $attachmentFloorplan = ['request' => $requestId, 'status' => '2', 'file' => $pathFloorplan, 'uploaded_by' => $leadId];

            $this->Attachments->create($attachmentFloorplan);

        }

    }

}