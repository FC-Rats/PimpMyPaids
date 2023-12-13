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
    $mail = new PHPMailer(true);

    try {
        $config = parse_ini_file('../includes/config.ini');
        //Server settings
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $config['mailadress'];
        $mail->Password = $config['mailpassword'];
        $mail->Port = 465;

        //Recipients
        $mail->setFrom($config['mailadress'], 'FC Rats');
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

function generateUniqueID($length)
{
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, 9)];
    }
    return $randomString;
}

function generateTokenLink($email, $conn)
{

    $token = generateUniqueID(12);
    
    $link = "http://etudiant.u-pem.fr/~chamsedine.amouche/PimpMyPaids/change.php?token=";
    $link .= $token;    
    if (!class_exists('Connection')) {
        include('./includes/connectionFunctions.php');
    } else {
        $config = parse_ini_file('config.ini');
        $db = new Connection($config['host'],$config['db'],$config['login'],$config['password']);
    }
    
    $updateToken= $db->query("UPDATE TRAN_USERS SET tokenR = :token WHERE email = :email;", array(array(":token", $token), array(":email", $email)));

    return $link;
}
function generateTokenLinkForValidationClient($emailClient, $conn)
{
    $token = generateUniqueID(12);

    $link = "http://etudiant.u-pem.fr/~leo.dessertenne/PimpMyPaids/clientValidation.php?token=";
    $link .= $token;
    if (!class_exists('Connection')) {
        include('./includes/connectionFunctions.php');
    } else {
        $config = parse_ini_file('config.ini');
        $db = new Connection($config['host'],$config['db'],$config['login'],$config['password']);
    }
    $updateToken= $db->query("UPDATE TRAN_USERS SET tokenR = :token WHERE email = :email;", array(array(":token", $token), array(":email", $emailClient)));
    return $link;
}
?>