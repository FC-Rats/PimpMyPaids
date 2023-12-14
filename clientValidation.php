<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

//include('./mailer/mailer.php');
if (!class_exists('Connection')) {
    include('./includes/connectionFunctions.php');
}

function decodeTokenForConfirmation($token, $secretKey)
{
    // Décoder le token depuis base64
    $decodedToken = base64_decode($token);

    // Déchiffrer les données avec AES-256-CBC
    $decryptedData = openssl_decrypt($decodedToken, 'aes-256-cbc', $secretKey, 0, $secretKey);

    // Diviser les données en tableau
    $dataArray = explode('|', $decryptedData);

    // Retourner les données
    return [
        'user' => $dataArray[0],
        'request' => $dataArray[1],
        'type' => $dataArray[2],
    ];
}

if ($_GET['token']) {
    $config = parse_ini_file('../includes/config.ini');
    $data = decodeTokenForConfirmation($_GET['token'], $config['secret-key']);

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
