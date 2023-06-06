<?php
Class EmailModel
{
    public static function sendOrderEmail($user_email, $order_number)
    {
       $body = Config::get('EMAIL_ORDER_CONTENT');

        $mail = new Mail;
        $mail_sent = $mail->sendMail($user_email, Config::get('EMAIL_ORDER_FROM_EMAIL'),
            Config::get('EMAIL_ORDER_FROM_NAME'),Config::get('EMAIL_ORDER_SUBJECT') . $order_number, $body
        );

        if ($mail_sent) {
            Session::add('feedback_positive', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_SUCCESSFUL'));
            return true;
        } else {
            Session::add('feedback_negative', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR') . $mail->getError() );
            return false;
        }
    } 
} 
?>