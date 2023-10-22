<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include('./db-connection.php');
include('./password_mail.php');

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function envoi_mail($to_email,$conn,$objet,$message)
{
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