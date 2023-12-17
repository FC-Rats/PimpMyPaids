<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

//include('./mailer/mailer.php');
if (!class_exists('Connection')) {
    include('connectionFunctions.php');
}

function decodeTokenForConfirmation($token, $secretKey) {

    $decodedToken = base64_decode($token);
    $iv = substr($decodedToken, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $encryptedData = substr($decodedToken, openssl_cipher_iv_length('aes-256-cbc'));
    $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $secretKey, 0, $iv);
    $dataArray = explode('|', $decryptedData);

    return [
        'user' => $dataArray[0],
        'request' => $dataArray[1],
        'type' => $dataArray[2],
    ];
}

if ($_GET['token']) {
    include('config.php');
    $data = decodeTokenForConfirmation($_GET['token'], $config['secret-key']['secret-key']);

    if (!empty($data)) {
        if ($data['type'] == 0) {
            $db->query("UPDATE TRAN_USERS SET state = 1 WHERE idUser = :idClient", [[":idClient", $data['user']]]);
            $db->query("DELETE FROM TRAN_REQUEST_PO WHERE idRequest = :idRequest", [[":idRequest", $data['request']]]);
        } else if ($data['type'] == 1) {
            $db->query("DELETE FROM TRAN_USERS WHERE idUser = :idClient", [[":idClient", $data['user']]]);
            $db->query("DELETE FROM TRAN_REQUEST_PO WHERE idRequest = :idRequest", [[":idRequest", $data['request']]]);
        }
        header("Location: ./index.php?m=1");
    } else {
        header("Location: ./index.php?m=2");
        exit;
    }
}
