<?php

namespace Core\support;

class Mail
{
    public static function send(string $to, string $toName, string $subject, string $body)
    {
        //     $mail = new PHPMailer(true);

        //     try {
        //         $mail->isSMTP();
        //         $mail->Host       = SMTP_HOST;
        //         $mail->SMTPDebug = 2;
        //         $mail->SMTPAuth   = true;
        //         $mail->Username   = SMTP_USER;
        //         $mail->Password   = SMTP_PASSWORD;
        //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //         $mail->Port       = SMTP_PORT;

        //         //Recipients
        //         $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
        //         $mail->addAddress($to, $toName);

        //         //Content
        //         $mail->isHTML(true);
        //         $mail->Subject = $subject;
        //         $mail->Body    = $body;

        //         $mail->send();
        //         return true;
        //     } catch (Exception $e) {
        //         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //         return false;
        //     }
    }

    // sendMail(
    //     $email,
    //     "lajoui zakariae",
    //     "email verifaction",
    //     '<a href="http://mvc.test/auth/verify_email.php?id='.$requestObj["id"].'&verif_code='.$requestObj["verif_code"].'">'
    // );
}
