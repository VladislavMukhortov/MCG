<?php
class knackApi {

    public $knackAppId = "5f454b7f3700c700154d3684";
    public $knackApiKey = "f4a30310-1b12-476c-a095-3a8e1c990cff";

    /**
     * @param $objectId int
     * @param $recordId string
     * @return object
     */
    public function getRecord($objectId, $recordId=null) {


        $record_url = 'https://api.knack.com/v1/objects/object_'.$objectId.'/records/'.$recordId;
        $curl = curl_init($record_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "X-Knack-Application-Id: ".$this->knackAppId,
            "X-Knack-REST-Api-Key: ".$this->knackApiKey
        ));
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $decoded = json_decode($curl_response);
        return $decoded;

    }

    /**
     * @param $objectId int
     * @param $filters array
     * @return object
     */
    public function searchRecords($objectId, $filters) {

        $record_url = 'https://api.knack.com/v1/objects/object_'.$objectId.'/records';
        $record_url = $record_url."?filters=".urlencode(json_encode($filters))."&rows_per_page=1000";

        $curl = curl_init($record_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "X-Knack-Application-Id: ".$this->knackAppId,
            "X-Knack-REST-Api-Key: ".$this->knackApiKey
        ));
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $decoded = json_decode($curl_response);
        return $decoded;

    }

    /**
     * @param $objectId int
     * @param $recordId string
     * @param $data array
     * @return object
     */
    public function updateRecord($objectId, $recordId, $data) {

        $record_url = 'https://api.knack.com/v1/objects/object_'.$objectId.'/records/'.$recordId;
        $curl = curl_init($record_url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "X-Knack-Application-Id: ".$this->knackAppId,
            "X-Knack-REST-Api-Key: ".$this->knackApiKey
        ));
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $decoded = json_decode($curl_response);
        return $decoded;

    }

    /**
     * @param $objectId int
     * @param $data array
     * @return object
     */
    public function insertRecord($objectId, $data) {

        $record_url = 'https://api.knack.com/v1/objects/object_'.$objectId.'/records';
        $curl = curl_init($record_url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "X-Knack-Application-Id: ".$this->knackAppId,
            "X-Knack-REST-Api-Key: ".$this->knackApiKey
        ));
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $decoded = json_decode($curl_response);
        return $decoded;

    }

    /**
     * @param $file
     * @return mixed
     */
    public function uploadFile($file) {
        $record_url = 'https://api.knack.com/v1/applications/'.$this->knackAppId.'/assets/file/upload';
        $curl = curl_init($record_url);
        $cFile = curl_file_create($file, null, "signature.svg");
        $data = array(
            'files' => $cFile
        );
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "X-Knack-REST-Api-Key: ".$this->knackApiKey,
        ));
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $decoded = json_decode($curl_response);
        return $decoded;
    }
}
?>