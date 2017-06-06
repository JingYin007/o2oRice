<?php
namespace phpmailer;

class Email{
    /**
     * @param $to
     * @param $send
     * @param $content
     * @return bool
     */
    public static function send($to,$send,$content){
        date_default_timezone_set('PRC');
        try{
            $mail = new PHPMailer();
            $mail->isSMTP();
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = 'html';
            $mail->Host = "smtp.163.com";
            $mail->Port = 25;
            $mail->SMTPAuth = true;
            $mail->Username = "15117972683@163.com";
            $mail->Password = "motzxx07070";
            $mail->setFrom($send, '清风');
            $mail->addAddress($to, '木头');
            $mail->Subject = '你若盛开，清风自来';
            $mail->msgHTML($content);
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message sent success!";
            }
        }catch (phpmailerException $e){
            return false;
        }
    }
}