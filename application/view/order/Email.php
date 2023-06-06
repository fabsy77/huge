<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require_once(__DIR__ . '../autoload.php');
class Email{

public static function sendOrderConfirmationEmail($customerEmail, $orderNumber)
{
    // Erstelle eine neue Instanz von PHPMailer
    $mail = new PHPMailer();

    try {
        // SMTP-Konfiguration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'deroupasshop@gmail.com';
        $mail->Password = 'DeRoupas123#';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Sender und Empfänger Einstellungen
        $mail->setFrom('DeRoupasShop@Gmail.com', 'DeRoupas Webshop');
        $mail->addAddress($customerEmail);

        // E-Mail Inhalt
        $mail->isHTML(true);
        $mail->Subject = 'Bestellbestätigung';
        $mail->Body = 'Vielen Dank für Ihre Bestellung! Ihre Bestellnummer lautet: ' . $orderNumber;

        // Sende die E-Mail
        $mail->send();
        echo 'Bestellbestätigung per E-Mail gesendet.';
    } catch (Exception $e) {
        echo 'Fehler beim Senden der E-Mail: ' . $e->getMessage();
    }
}
}

?>