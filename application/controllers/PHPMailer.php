<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PHPMailer extends CI_Controller {

    function test_mail() {
        // load library email
        $this->load->library('PHPMailerAutoload');

        $mail = new PHPMailer();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';

        // set smtp
        $mail->isSMTP();
        $mail->Host = 'mx1.idhostinger.com';
        $mail->Port = '2525';
        $mail->SMTPAuth = true;
        $mail->Username = 'fajar_v1@fajar-isnandio.com';
        $mail->Password = 'fajar123';
        $mail->WordWrap = 50;
        // set email content
        $mail->setFrom('fajar@fajar-isnandio.com', 'Fajar Ganteng');
        $mail->addAddress('fajar_v1@fajar-isnandio.com');
        $mail->Subject = 'Test PHPMailer';
        $mail->Body = 'Email ini dikirim oleh PHPMailer';

        $mail->send();
    }

    function test_gmail() {
        $this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "nexter@seno.web.id";
        $mail->Password = "Ander 4ll i5 well";
        $mail->setFrom('nexter@seno.web.id', 'First Last');
        $mail->addReplyTo('nexter@seno.web.id', 'First Last');
        $mail->addAddress('nexter.three@gmail.com', 'John Doe');
        $mail->Subject = 'PHPMailer GMail SMTP test';
        $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        $mail->AltBody = 'This is a plain-text message body';
        $mail->addAttachment('images/phpmailer_mini.png');
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }

}
