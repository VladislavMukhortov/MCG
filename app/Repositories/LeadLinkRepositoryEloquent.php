<?php

namespace App\Repositories;




use App\Http\Controllers\GoogleApiController;
use App\Mail\LeadLinkEmailMail;
use App\Models\HashLink;
use App\Models\Leads;
use App\Models\User;
use Google_Client;
use Google_Service_Gmail;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\RepeatRequestRepositoryRepository;
use App\Models\RepeatRequestRepository;
use App\Validators\RepeatRequestRepositoryValidator;

/**
 * Class LeadLinkRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeadLinkRepositoryEloquent extends BaseRepository implements RepeatRequestRepositoryRepository
{

    protected $googleApi;

    public function __construct (GoogleApiController $googleApi)
    {
        $this->googleApi = $googleApi;
    }


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HashLink::class;
    }


    public function sendLeadLink ($request)
    {
        $values = $request->all();

        $generatedLink = HashLink::where('user_id', $values['user-id'])->first();

        $user = Leads::find($values['user-id']);

//dd($generatedLink);

        if (isset($generatedLink['link'])) {

            $message = $this->googleApi->createMessage("noreply@moderncitigroup.com", $user->email, "Create new request", "<p>Greetings $user->name at $user->email.</p><p>Please, use link below to create new request.</p>".URL::route('lead-form.show', $generatedLink->link));

            $this->googleApi->sendMessage($message);

            return redirect()->back()->with('email-success', 'Message sent.');

        } else {

           $hash = Str::random(10);

            HashLink::create(['lead_id' => $values['lead-id'], 'user_id' => $values['user-id'], 'link' => $hash]);

            $message = $this->googleApi->createMessage("noreply@moderncitigroup.com", $user->email, "Create new request", "<p>Greetings $user->name at $user->email.</p><p>Please, use link below to create new request.</p>".URL::route('lead-form.show', $hash));

            $this->googleApi->sendMessage($message);

            return redirect()->back()->with('email-success', 'Message sent.');

        }

    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
