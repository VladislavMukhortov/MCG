<?php

namespace  App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Drive;
use Google_Service_Gmail;
use Google_Service_Gmail_Draft;
use Google_Service_Gmail_Message;

class GoogleApiController extends Controller
{


    /**
     * Returns an authorized Api client.
     * @return Google_Client the authorized client object
     * @throws \Google\Exception
     */
    function getClient()
    {
        $client = new Google_Client();
        $client->setRedirectUri('http://' . 'modernciti.group' . '/oauth2callback.php');
        $client->setApplicationName('Gmail Api PHP');
        $client->setScopes(Google_Service_Gmail::GMAIL_SEND);
        $client->setAuthConfig( base_path().'/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode("4/0AY0e-g5Br4lqWxXR7PGql38BiUPuciHygXePCTlWZHLZlP2Tf00OKeeDoMc8_IHfNsI88w");
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }

        return $client;
    }

    /**
     * @param $sender string sender email address
     * @param $to string recipient email address
     * @param $subject string email subject
     * @param $messageText string email text
     * @return Google_Service_Gmail_Message
     */
    public function createMessage($sender, $to, $subject, $messageText, $attachments=[])
    {
        $subjectCharset = $charset = 'utf-8';

        $emailWraperStyle = 'background: #f5f6fa; font-size: 14px; line-height: 22px; font-weight: 400; color: #526484; width: 100%;';
        $emailHeaderFooterStyle = 'width: 100%; max-width: 620px; margin: 0 auto;';
        $emailTitleStyle = 'font-size: 13px; color: #0084c0; padding-top: 12px;';
        $emailBodyStyle = 'width: 96%; margin: 0 auto; background: #ffffff;';
        $emailSocialLiStyle = 'display: inline-block; padding: 4px;';

        $messageBody = <<<HTML
<table class="email-wraper" style="$emailWraperStyle">
    <tbody>
        <tr>
            <td style="padding-top: 2.7rem; padding-bottom: 2.7rem;">
                <table class="email-header" style="$emailHeaderFooterStyle">
                    <tbody>
                        <tr>
                            <td style="text-align: center; padding-bottom: 1.5rem;">
                                <a href="https://moderncitigroup.com">
                                    <img style="height: 80px;" src="https://moderncitigroup.com/uploads/Modern_Citi_Original_logo_tr_copy_AdN5fHb.png" alt="logo">
                                </a>
                                <p class="email-title" style="$emailTitleStyle">
                                    $subject
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="email-body" style="$emailBodyStyle">
                    <tbody>
                        <tr>
                            <td style="padding: 2.75rem;">$messageText</td>
                        </tr>
                    </tbody>
                </table>
                <table style="$emailHeaderFooterStyle" class="email-footer">
                    <tbody>
                        <tr>
                            <td style="text-align: center; padding-top: 1.5rem;">
                                <p style="font-size: 11px; margin-bottom: 1rem;">
                                    Copyright © 2020 Modern Citi Group Inc. All rights reserved.
                                </p>
                                <hr style="width: 25%; margin: 20px auto; border-color: rgb(153,153,153); background-color: rgb(153,153,153);">
                                
                                <p style="font-size: 11px;">
                                    ⑊ <span style="color: #0084c0;">A</span>rchitecture • <span style="color: #0084c0;">D</span>esign • <span style="color: #0084c0;">R</span>emodeling
                                    <br><br>    
                                    ⑊ <span style="color: #0084c0;">N</span>ew York •  <span style="color: #0084c0;">N</span>ew Jersey •  <span style="color: #0084c0;">S</span>outh Florida
                                    <br><br>
                                    1 844 <span style="color: #0084c0;">MCG</span> 0044 &nbsp; • &nbsp; 1 844 <span style="color: #0084c0;">624</span> 0044
                                    <br><br>
                                    <a href="https://moderncitigroup.com">moderncitigroup.com</a>
                                </p>
                                
                                <ul style="padding-left: 0px;">
                                    <li style="$emailSocialLiStyle">
                                        <a href="#">
                                            <img style="height: 32px;" src="https://image.flaticon.com/icons/png/512/124/124010.png" alt="">
                                        </a>
                                    </li>
                                    <li style="$emailSocialLiStyle">
                                        <a href="#">
                                            <img style="height: 32px;" src="https://image.flaticon.com/icons/png/512/174/174857.png" alt="">
                                        </a>
                                    </li>
                                </ul>
                                <p style="font-size: 10px; color: rgb(153,153,153);">
                                    <b>IMPORTANT</b>: The contents of this email and any attachments are confidential. They are intended for the named recipient(s) only. If you have received this email by mistake, please notify the sender immediately and do not disclose the contents to anyone or make copies thereof.
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
HTML;

        $boundary = uniqid(rand(), true);
        $rawMessageString = "From: <{$sender}>\r\n";
        $rawMessageString .= "To: <{$to}>\r\n";
        $rawMessageString .= 'Subject: =?' . $subjectCharset . '?B?' . base64_encode($subject) . "?=\r\n";
        $rawMessageString .= "MIME-Version: 1.0\r\n";
        $rawMessageString .= 'Content-type: Multipart/Mixed; boundary="' . $boundary . '"' . "\r\n";
        $rawMessageString .= "\r\n--{$boundary}\r\n";
        $rawMessageString .= 'Content-Type: text/html; charset=' . $charset . "\r\n";
        $rawMessageString .= "Content-Transfer-Encoding: base64" . "\r\n\r\n";
        $rawMessageString .= str_replace("\n","",$messageBody)."\r\n";
        $rawMessageString .= "--{$boundary}\r\n";

        foreach ($attachments as $fileName => $fileData) {

            $fileData = base64_encode($fileData);
            $rawMessageString .= "\r\n--{$boundary}\r\n";
            $rawMessageString .= 'Content-Type: '. "application/pdf" .'; name="'. $fileName .'";' . "\r\n";
            $rawMessageString .= 'Content-ID: <' . $to. '>' . "\r\n";
            $rawMessageString .= 'Content-Description: ' . $fileName . ';' . "\r\n";
            $rawMessageString .= 'Content-Disposition: attachment; filename="' . $fileName . '"; size=' . strlen($fileData). ';' . "\r\n";
            $rawMessageString .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
            $rawMessageString .= chunk_split($fileData, 76, "\n") . "\r\n";
            $rawMessageString .= "--{$boundary}\r\n";

        }
        //dd($rawMessageString);
        $mime = rtrim(strtr(base64_encode($rawMessageString), '+/', '-_'), '=');
        return $mime;
    }

    /**
     * @param $service Google_Service_Gmail an authorized Gmail Api service instance.
     * @param $user string User's email address or "me"
     * @param $message Google_Service_Gmail_Message
     * @return Google_Service_Gmail_Draft
     */
    public function createDraft($service, $user, $message)
    {
        $draft = new Google_Service_Gmail_Draft();
        $draft->setMessage($message);

        try {
            $draft = $service->users_drafts->create($user, $draft);
            print 'Draft ID: ' . $draft->getId();
        } catch (Exception $e) {
            print 'An error occurred: ' . $e->getMessage();
        }

        return $draft;
    }

    /**
     * Send prepared message to Google Api
     *
     * @param $prepMessage
     * @return true|string
     * @throws \Google\Exception
     */
    public function sendMessage($prepMessage)
    {
        $client = $this->getClient();

        $service = new \Google_Service_Gmail($client);
        $mailer = $service->users_messages;

            $message = new \Google_Service_Gmail_Message();
            $message->setRaw($prepMessage);
            $mailer->send("me", $message);
    }

    /**
     * @param $service Google_Service_Gmail an authorized Gmail Api service instance.
     * @param $userId string User's email address or "me"
     * @param $message Google_Service_Gmail_Message
     * @return true|string
     */
    public function createEvent($userEmail, $summary, $location, $description, $start, $end, $recurrence, $attendees, $reminders) {

        $gmailApi = new gmailApi;
        $user = $gmailApi->client;
        $user->setSubject($userEmail);
        $service = new Google_Service_Gmail($user);
        $event = new Google_Service_Calendar_Event(array(
            'summary' => $summary,
            'location' => $location,
            'description' => $description,
            'start' => array(
                'dateTime' => $start,
                'timeZone' => 'America/Los_Angeles',
            ),
            'end' => array(
                'dateTime' => $end,
                'timeZone' => 'America/Los_Angeles',
            ),
            'recurrence' => array(
                //'RRULE:FREQ=DAILY;COUNT=2'
                $recurrence
            ),
            'attendees' => array(
                //array('email' => 'lpage@example.com'),
                //array('email' => 'sbrin@example.com'),
                $attendees
            ),
            'reminders' => array(
                /*
                'useDefault' => FALSE,
                'overrides' => array(
                    array('method' => 'email', 'minutes' => 24 * 60),
                    array('method' => 'popup', 'minutes' => 10),
                ),
                */
                $reminders
            ),
        ));

        $calendarId = 'primary';
        $event = $service->events->insert($calendarId, $event);
        return $event;
    }

    /**
     * @param $body string
     * @return FALSE|string
     */
    public static function decodeBody($body) {
        $rawData = $body;
        $sanitizedData = strtr($rawData,'-_', '+/');
        $decodedMessage = base64_decode($sanitizedData);
        if(!$decodedMessage){
            $decodedMessage = FALSE;
        }
        return $decodedMessage;
    }
}