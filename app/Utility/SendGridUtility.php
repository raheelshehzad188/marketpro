<?php

namespace App\Utility;

use SendGrid\Mail\From;
use SendGrid\Mail\To;
use SendGrid\Mail\Mail;

class SendGridUtility
{

    public function  do_send($template_id,$email_data)
    {

        $apiKey = "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";
        $from = new From("info@tmracingsweden.se", "Tm Racing Sweden");
        $tos = [
            new To(
                $email_data['email'],
                $email_data['name'],
                $email_data['variables'],
            )
        ];
        $email = new Mail(
            $from,
            $tos
        );
        $email->setTemplateId($template_id);
        $sendgrid = new \SendGrid($apiKey);
        try {
            $response = $sendgrid->send($email);
            // print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
        } catch (Exception $e) {
            //echo 'Caught exception: ' .  $e->getMessage() . "\n";
        }
    }
}
