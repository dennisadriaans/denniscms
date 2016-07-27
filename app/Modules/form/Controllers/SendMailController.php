<?php namespace App\Modules\form\Controllers;

use Mail;
use View;
use App\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendMailController extends Controller {

    public function sendMail(Request $request)
    {
        echo 'Bedankt voor uw bericht. Wij nemen z.s.m contact met u op.';

        $lang = \Session::get('my.locale');

        if ($lang) {
            if($lang == 'en') {
                $data = [
                    "name" => $request->input('Name'),
                    "lastname" => $request->input('Lastname'),
                    "email" => $request->input('E-mail'),
                    "bericht" => $request->input('Message')
                ];
                $this->thisSendMail($data);
            }
            if($lang == 'nl') {

                $data = [
                    "name" => $request->input('naam'),
                    "lastname" => $request->input('Achternaam'),
                    "email" => $request->input('E-mailadres'),
                    "bericht" => $request->input('Bericht')
                ];
                $this->thisSendMail($data);
            }

            if($lang == 'de') {
                $data = [
                    "name" => $request->input('Name'),
                    "lastname" => $request->input('Nachname'),
                    "email" => $request->input('E-mail-Adresse'),
                    "bericht" => $request->input('Nachricht')
                ];
                $this->thisSendMail($data);
            }
        } else {
            $data = [
                "name" => $request->input('naam'),
                "lastname" => $request->input('Achternaam'),
                "email" => $request->input('E-mailadres'),
                "bericht" => $request->input('Bericht')
            ];
            $this->thisSendMailesponse;
        }
    }

    public function thisSendMail($data)
    {
       \Mail::send('modules.form.templates.mail-template', $data, function ($message) {
            $message->to('destadsboerderij@caiway.net', 'Laurens')->subject('U heeft een nieuw bericht van de website.');
        });

        return response()->json(['message' => 'Bedankt voor uw bericht. Wij nemen z.s.m contact met u op.']);
    }
}
