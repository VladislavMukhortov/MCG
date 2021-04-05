<?php

namespace App\Http\Controllers\Api\v_1\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactSendEmail;
use App\Models\Contact;
use App\Models\Notes;
use App\Services\ContactService;
use App\Services\GoogleApiService;
use Illuminate\Http\Request;
use Session;
use Validators;
use App\Http\Requests\ContractFormRequest;

class ContactController extends Controller
{

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

    public function show(int $contactId)
    {
        return response()->json([
            'success' => false,
            'data' => [
                'contact'  => Contact::getContactByIdWithAddress($contactId),
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

    public function update(ContractFormRequest $request, $contactId)
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
        if($addContact->addContactToLead($request, $id))
        {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.contacts.add_to_lead.success')
                ],
            ], 200);
        }else{

            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.contacts.add_to_lead.wrong')
                ],
            ], 200);

        }
    }

    public function removeFromLead($id, $contactId, ContactService $removeContactLead)
    {
        if($removeContactLead->removeContactFromLead($id, $contactId))
        {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.contacts.delete.success')
                ],
            ], 200);
        }else{
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.contacts.delete.wrong')
                ],
            ], 200);

        }
    }

    public function sendEmail($id, ContactSendEmail $request, Contact $contact, GoogleApiService $googleApi)
    {
        if ($contact->findOrFail($id)) {

            $contact = $contact->find($id);

            $message = $googleApi->createMessage("noreply@moderncitigroup.com", $contact->email, "Message from MCG", "<p>Greetings $contact->name at $contact->email.</p><p>You have got a new message from the MCG team.</p><p></p><p>$request->subject</p><p>$request->body</p>");

            $googleApi->sendMessage($message);

            return response()->json(['success' => true, 'messages' => [__('pages.contacts.email.success')]], 200);
        }


    }

}
