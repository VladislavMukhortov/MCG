<?php
/**
 * Created by PhpStorm.
 * User: RedEclipse
 * Date: 15.02.2021
 * Time: 12:07
 */

namespace App\Services;


use App\Models\Email;
use App\Models\EstimateRepository;
use App\Models\Leads;
use App\Models\Request;

class EmailService
{

    protected $email;
    protected $googleApi;

    public function __construct(Email $email, GoogleApiService $googleApi)
    {
        $this->email = $email;
        $this->googleApi = $googleApi;
    }

    /**
     * List all records
     *
     * @param string $request
     * @return mixed
     */
    public function index(string $request)
    {
        return $this->email->paginate($request);
    }

    /**
     * Store Email details in DB and send Email using Google API
     *
     * @param array $request
     * @return
     * @throws \Google\Exception
     */
    public function store(array $request)
    {

        $request['user_id'] = auth('api')->user()->id;

        $receiver = self::getReceiverInfo($request);

        $request['name'] = isset($receiver['name']) ? $receiver["name"] : $request['name'];

        $request['email'] = isset($receiver['email']) ? $receiver["email"] : $request['email'];

        $emailId = $this->email->create($request)->id;

        $message = $this->googleApi->createMessage("noreply@moderncitigroup.com", $request['email'], "Message from MCG", "<p>Greetings ".$request['name']." at ".$request['email']."</p><p>You have got a new message from the MCG team.</p><p></p><p>".$request['title']."</p><p>".$request['body']."</p>");

        $this->googleApi->sendMessage($message);

        return $emailId;

    }

    /**
     * Delete Email record by ID
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->email->findOrFail($id)->delete();

        return $id;
    }

    /**
     * Find Contact data by Estimate or Lead or Request ID
     *
     * @param array $request
     * @return mixed
     */
    public function getReceiverInfo(array $request)
    {
        if (isset($request['estimate_id']))
        {
           return EstimateRepository::with('contacts')->findOrFail($request['estimate_id'])->get()->pluck('contacts')->first()->toArray();
        }
        if (isset($request['lead_id']))
        {
            return Leads::with('contacts')->findOrFail($request['lead_id'])->get()->pluck('contacts')->first()->toArray();

        }
        if (isset($request['request_id']))
        {
            return Request::with('contacts')->findOrFail($request['request_id'])->get()->pluck('contacts')->first()->toArray();
        }
    }

}