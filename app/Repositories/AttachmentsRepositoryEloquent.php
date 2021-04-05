<?php

namespace App\Repositories;

use App\Contracts\AttachmentsRepository;
use App\Mail\AttachmentLinkEmail;
use App\Models\AttachmentLink;
use App\Models\Attachments;
use App\Models\Request;
use App\Models\RequestAttachment;
use App\Models\User;
use App\Repositories\EstimateAttachmentRepositoryEloquent;
use App\Repositories\LeadsAttachmentRepositoryEloquent;
use App\Repositories\RequestAttachmentRepositoryEloquent;
use App\Repositories\SubcontractorAttachmentRepositoryEloquent;
use App\Validators\AttachmentsValidator;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\File;
/**
 * Class AttachmentsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AttachmentsRepositoryEloquent extends BaseRepository implements AttachmentsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $Attachments;
    protected $estimate_attachments;
    protected $leads_attachments;
    protected $requests_attachments;
    protected $subcontractor_attachments;
    protected $attachment_link;
    protected $request_attachment;

    //todo fix this repo
    public function __construct (Attachments $Attachments, EstimateAttachmentRepositoryEloquent $estimate_attachments, LeadsAttachmentRepositoryEloquent $leads_attachments, RequestAttachmentRepositoryEloquent $requests_attachments, SubcontractorAttachmentRepositoryEloquent $subcontractor_attachments, AttachmentLink $attachment_link, RequestAttachment $request_attachment)
    {
        $this->Attachments = $Attachments;
        $this->estimate_attachments = $estimate_attachments;
        $this->leads_attachments = $leads_attachments;
        $this->requests_attachments = $requests_attachments;
        $this->subcontractor_attachments = $subcontractor_attachments;
        $this->attachment_link = $attachment_link;
        $this->request_attachment = $request_attachment;

    }

    public function model ()
    {
        return Attachments::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot ()
    {
        $this->pushCriteria(app(RequestCriteria::class)); //todo rewatch
    }


}
