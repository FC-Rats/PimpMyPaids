<?php

require_once 'framework/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Créer un nouveau tableau (spreadsheet)
$spreadsheet = new Spreadsheet();

// Accéder à la feuille de travail active
$sheet = $spreadsheet->getActiveSheet();

// Définir le contenu de la cellule A1
$sheet->setCellValue('A1', 'Bonjour PHPSpreadSheet!');
$sheet->getStyle('A1')->getFont()->setBold(true);
$sheet->getStyle('A1')->getFont()->setName('Arial');
$sheet->getStyle('A1')->getFont()->setSize(16);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="test_spreadsheet.xlsx"');

// Créer un écrivain pour écrire le fichier
$writer = new Xlsx($spreadsheet);

// Sauvegarder le fichier sur le serveur
$writer->save('php://output');

echo "Le fichier test_spreadsheet.xlsx a été créé avec succès.";
?>