<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include('./db-connection.php');

require '../framework/PHPMailer/src/Exception.php';
require '../framework/PHPMailer/src/PHPMailer.php';
require '../framework/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function envoi_mail($to_email,$conn,$objet,$message)
{
    include('../mailer/passwordMail.php');
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'projet.saebut@gmail.com';
        $mail->Password = $password;
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('projet.saebut@gmail.com', 'FC Rats');
        $mail->addAddress(trim(strip_tags($to_email)), 'Client');

        //Content à changer
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = trim(strip_tags($objet));
        $mail->Body = trim(strip_tags($message));

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}