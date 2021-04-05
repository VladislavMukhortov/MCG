<?php


namespace App\Http\Controllers;


use App\Models\Leads;

class HelperController
{
    public static function getStates(): array
    {
        return ['AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY'];
    }

    public static function addressGenerate($data): string
    {
        $address = isset($data['address']) ? $data['address'].',':'';
        $address .= isset($data['street']) ? $data['street'].',':'';
//        $address .= isset($data['street_address2']) ? $data['street_address2'].',':'';
        $address .= isset($data['state']) ? $data['state'].',':'';
        $address .= isset($data['city']) ? $data['city'].',':'';
        $address .= isset($data['zip']) ? $data['zip']:'';
        if (substr ( $address, -1, 1) == ',') {
            $address = mb_substr($address, 0, -1);
        }

        return $address;
    }

    public static function nameGenerate(array $data): string
    {
        $name = isset($data['first']) ? $data['first'].' ':'';
        $name .= isset($data['last']) ? $data['last'].' ':'';

        return $name;
    }


    public static function roomWorktypeGenerate()
    {
        return [1 => 'Do nothing', 2 => 'Refinish/Refresh', 3 => 'Replace', 4 => 'Remove existing', 5 => 'Install/Add new'];
    }

    public static function roomTypeGenerate()
    {
        return [1 => 'Bath', 2 => 'Kitchen', 3 => 'Master Bedroom', 4 => 'Guest Bedroom', 5 => 'Living Room', 6 => 'Dining Room', 7 => 'Other', 8 => 'Hallway / Corridor', 9 => 'Office', 10 => 'Den', 11 => 'Nursery', 12 => 'Basement'];
    }

    public static function type()
    {
        return [0 => '', 1 => 'Apartment building', 2 => 'Single / Multi-family home'];
    }
    public static function stage()
    {
        return [0 => '', 1 => 'I own the property', 2 => 'Im in contact with property', 3 => 'Im thinking of purchasing property', 4 => 'Other'];
    }
    public static function startData()
    {
        return [0 => '', 1 => 'As soon as possible', 2 => 'In 1 month', 3 => 'In 2 months', 4 => 'In 3-6 months', 5 => 'Not sure'];
    }

    public static function nameLeadGenerate($leadId): string
    {
        if (!$leadId){
            return false;
        }

        $leadNameData = Leads::select(['name', 'last_name'])->find($leadId);

        $nameData = [
            'first' => $leadNameData->name,
            'last' => $leadNameData->last_name,
        ];

        return self::nameGenerate($nameData);
    }

    public static function explodeAddress($address): array
    {
        if (gettype($address) != 'string') {
            $explodeArr = [];
        } else {
            $explodeArr = explode(',', $address);
        }



        $addressArr['address'] = isset($explodeArr[0]) ? $explodeArr[0] : null;
        $addressArr['street_address'] = isset($explodeArr[1]) ? $explodeArr[1] : null;
        $addressArr['state'] = isset($explodeArr[2]) ? $explodeArr[2] : null;
        $addressArr['city'] = isset($explodeArr[3]) ? $explodeArr[3] : null;
        $addressArr['zip'] = isset($explodeArr[4]) ? str_replace('.', '', $explodeArr[4]) : null;

        return $addressArr;
    }

}