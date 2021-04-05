<?php


namespace App\Services;


use App\Models\Contact;
use App\Models\LeadContact;
use App\Models\Leads;
use Illuminate\Http\Request;

class ContactService
{
    public static function storeContact(array $data)
    {
        $contactObj = new Contact();

        $data['created'] = date('Y-m-d H:i:s');
        $data['display_name'] = $data['name'] . '(' . $data['email'] . ')';
        $data['created_by'] = auth('api')->user()->id;
        $address = $contactObj->address()->create($data);
        $data['address_id'] = $address->id;

        if ($contact = $contactObj->create($data)) {
            $data['contact_id'] = $contact['id'];
            return $contact['id'];
        } else {
            return response()->json([
                'success' => false,
                'messages' => [
                    __('pages.contacts.create.wrong')
                ],
            ], 500);
        }

    }

    public static function updateContact(array $data, int $contactId)
    {

        if (!$contact = Contact::find($contactId)->update($data)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.contacts.update.wrong')
                ],
            ], 500);
        }

        $contactAddressUpdate = Contact::find($contactId)->address()->update([
            'address' => $data['address'],
            'street'  => $data['street'],
            'state'   => $data['state'],
            'city'    => $data['city'],
            'zip'     => $data['zip'],
        ]);

        if(!$contactAddressUpdate){
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.contacts.update.wrong')
                ],
            ], 500);
        }

        return $contactId;
    }

    public static function deleteContact($contactId)
    {
        if (!Contact::find($contactId)->delete()) {
            return response()->json([
                'success' => false,
                'messages' => [
                    __('pages.contacts.delete.wrong')
                ],
            ], 500);
        }

        return true;
    }

    public static function addContactToLead($request, $id)
    {

        if(Leads::find($id)){
        if(!LeadContact::where('leads_id', $id)->where('contact_id', $request->get('contact_id'))->first()){

         LeadContact::create([
                'leads_id' => $id,
               'contact_id' => $request->get('contact_id')]);

        return true;
        }else{

        return false;
        }
        }else{
            return false;
        }

//        if (!empty($request->get('contact_id'))) {
//            $leadContact = LeadContact::create([
//                'leads_id' => $id,
//                'contact_id' => $request->get('contact_id'),
//            ]);
//
//            if (!$leadContact) {
//                return response()->json([
//                    'success' => false,
//                    'messages' => [
//                        __('pages.contacts.add_to_lead.wrong')
//                    ],
//                ], 500);
//            }
//        }
//
//        return response()->json([
//            'success' => false,
//            'messages' => [
//                __('pages.contacts.add_to_lead.wrong')
//            ],
//        ], 500);
    }

    public static function removeContactFromLead($id, $contactId)
    {

        if(Leads::find($id)){

            if(LeadContact::where('leads_id', $id)->where('contact_id', $contactId)->first()){

                LeadContact::where('contact_id', $contactId)
                ->where('leads_id', $id)
                ->delete();
                return true;
            }else{

                return false;
            }
        }else{
            return false;
        }

//        if (!empty($contactId)) {
//            $leadContactDel = LeadContact::where('contact_id', $contactId)
//                ->where('leads_id', $id)
//                ->delete();
//            if(!$leadContactDel){
//                return response()->json([
//                    'success' => false,
//                    'messages' => [
//                        __('pages.contacts.remove_from_lead.wrong'),
//                    ],
//                ], 500);
//            }
//
//        }
//
//        return response()->json([
//            'success' => false,
//            'messages' => [
//                __('pages.contacts.remove_from_lead.empty_contact_id'),
//            ],
//        ], 500);

    }

}