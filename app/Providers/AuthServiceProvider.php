<?php

namespace App\Providers;

use App\Models\Attachments;
use App\Models\Bid;
use App\Models\Contact;
//use App\Models\CSICodes;
use App\Models\Document;
use App\Models\EstimateRepository;
use App\Models\EstimateTemplateRepository;
use App\Models\GeneralContractors;
use App\Models\Leads;
use App\Models\Project;
use App\Models\Question;
use App\Models\Remark;
use App\Models\RemarkFile;
use App\Models\Request;
use App\Models\SubContractors;
use App\Models\Task;
use App\Models\User;
use App\Policies\AttachmentPolicy;
use App\Policies\BidPolicy;
use App\Policies\ContactPolicy;
use App\Policies\CSICodePolicy;
use App\Policies\DocumentPolicy;
use App\Policies\EstimatePolicy;
use App\Policies\EstimateTemplatePolicy;
use App\Policies\GeneralContractorPolicy;
use App\Policies\LeadPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\RemarkFilePolicy;
use App\Policies\RemarkPolicy;
use App\Policies\RequestPolicy;
use App\Policies\SubcontractorPolicy;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        GeneralContractors::class           => GeneralContractorPolicy::class,
        EstimateTemplateRepository::class   => EstimateTemplatePolicy::class,
        SubContractors::class               => SubcontractorPolicy::class,
        Attachments::class                  => AttachmentPolicy::class,
        Question::class                     => QuestionPolicy::class,
        Remark::class                       => RemarkPolicy::class,
        RemarkFile::class                   => RemarkFilePolicy::class,
        EstimateRepository::class           => EstimatePolicy::class,
        Document::class                     => DocumentPolicy::class,
//        CSICodes::class                     => CSICodePolicy::class,
        Project::class                      => ProjectPolicy::class,
        Contact::class                      => ContactPolicy::class,
        Request::class                      => RequestPolicy::class,
        Leads::class                        => LeadPolicy::class,
        User::class                         => UserPolicy::class,
        Task::class                         => TaskPolicy::class,
        Bid::class                          => BidPolicy::class,
    ];
}
