<?php

namespace App\Services;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendMail($params)
    {
        $mails = array();
        foreach ($params['to'] as $value) {
            $response =  Mail::to($value['email'])->send(new SendMail($params['view'], $params['subject'], $params['params']));
            array_push($mails, $response);
        }
        return $mails;
    }
}
