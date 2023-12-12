<?php
// download.php
if (isset($_GET['file'])) {
    $filename = $_GET['file'];
    $filePath = '../../' . $filename;

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        // Vous pouvez supprimer le fichier après téléchargement si nécessaire
        unlink($filePath);
        exit;
    } else {
        http_response_code(404);
        echo "Erreur: Le fichier n'existe pas.";
    }
}
?>