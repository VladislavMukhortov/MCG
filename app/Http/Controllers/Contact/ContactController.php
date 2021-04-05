<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GoogleApiController;
use App\Models\Address;
use App\Models\Contact;
use App\Models\LeadContact;
use App\Models\Notes;
use App\Services\ContactService;
use Illuminate\Http\Request;
use App\Repositories\ContactRepositoryEloquent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Session;
use Validators;
use App\Http\Requests\ContractFormRequest;
use App\Http\Controllers\HelperController;

class ContactController extends Controller
{

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index(Contact $contacts)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'contacts' => $contacts->with('address')->get()->all(),
            ]
        ], 200);
    }

    public function store(ContractFormRequest $request)
    {
        $contactId = ContactService::storeContact($request->all());

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.contacts.create.success')
            ],
            'data' => [
                'contactId' => $contactId,
            ]
        ], 200);
    }

    public function show($contactId)
    {
        return response()->json([
            'success' => false,
            'data' => [
                'contact'  =>  $this->contact->with('address')->find($contactId)
            ]
        ], 200);
    }

    public function getContactNoteList(int $contactId)
    {
        return response()->json([
            'success' => false,
            'data' => [
                'noteList' => Notes::getContactNoteList($contactId),
            ]
        ], 200);
    }

    public function update(Request $request, $contactId)
    {
        ContactService::updateContact($request->all(), $contactId);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.contacts.update.success')
            ],
        ], 200);
    }

    public function destroy(int $contactId)
    {
        ContactService::deleteContact($contactId);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.contacts.delete.success')
            ],
        ], 200);
    }

    public function getMyContacts()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'myContacts' => Contact::getUserContacts(),
            ]
        ], 200);
    }

    public function getAllContacts()
    {

        return response()->json([
            'success' => true,
            'data' => [
                'allContacts' => Contact::getAllContacts(),
            ]
        ], 200);
    }

    public function addContactToLead(Request $request, $id, ContactService $addContact)
    {

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.contacts.add_to_lead.success')
            ],
        ], 200);

    }

    public function removeFromLead($id, $contactId)
    {
        ContactService::removeContactFromLead($id, $contactId);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.contacts.remove_from_lead.success')
            ],
        ], 200);
    }

    public function sendEmail(Request $request, GoogleApiController $googleApi)
    {
        $message = $googleApi->createMessage("noreply@moderncitigroup.com", $request->email, "Message from MCG", "<p>Greetings $request->name at $request->email.</p><p>You have got a new message from the MCG team.</p><p></p><p>$request->subject</p><p>$request->body</p>");

        $googleApi->sendMessage($message);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.contacts.email.success')
            ]
        ], 200);

    }

}
