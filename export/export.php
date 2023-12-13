<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../framework/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

function exportToXlsx($filename, $headers, $data, $title, $filters, $valueFilters) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    //date du jour
    $today = date("d/m/Y");

    //titre et date
    $sheet->setCellValue('A1', $title);
    $sheet->setCellValue('B1', 'Extrait du : '.$today);
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('B1')->getFont()->setBold(true);
    $sheet->getStyle('A1')->getFont()->setName('Arial');
    $sheet->getStyle('A1')->getFont()->setSize(16);
    $sheet->getStyle('B1')->getFont()->setName('Arial');
    $sheet->getStyle('B1')->getFont()->setSize(16);

    // Définir les en-têtes
    $column = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($column . '3', $header);
        $column++;
    }

    // Remplir les données
    $rowNumber = 4; // Commence à la deuxième ligne de la feuille Excel
    foreach ($data as $row) {
        $column = 'A';
        foreach ($row as $cell) {
            $sheet->setCellValueExplicit($column . $rowNumber, $cell, PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getStyle($column . '3')->getFont()->setBold(true);
            $column++;
        }
        $rowNumber++;
    }

    //Filtres
    $sheet->setCellValue('D1', 'Filtres :');
    $sheet->getStyle('D1')->getFont()->setBold(true);
    $column = 'E';
    foreach ($filters as $filter) {
        $count = 0;
        $sheet->setCellValue($column . '1', $filter . ' : ' . $valueFilters[$filter]);
        $count++;
        $column++;
    }

    // Créer le writer et envoyer le fichier pour téléchargement
    $writer = new Xlsx($spreadsheet);
    $filePath = '../../' . $filename;
    $writer->save($filePath);

    echo json_encode(["fileUrl" => "export/download.php?file=" . basename($filePath)]);
}

function exportToCsv($filename, $headers, $data, $title, $filters, $valueFilters) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Date du jour
    $today = date("d/m/Y");

    // Titre et date - Veuillez noter que la mise en forme n'est pas prise en charge dans le CSV
    $sheet->setCellValue('A1', $title);
    $sheet->setCellValue('B1', 'Extrait du : ' . $today);

    // Définir les en-têtes - la mise en forme ne sera pas reflétée dans le CSV
    $column = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($column . '3', $header);
        $column++;
    }

    // Remplir les données
    $rowNumber = 4;
    foreach ($data as $row) {
        $column = 'A';
        foreach ($row as $cell) {
            $sheet->setCellValue($column . $rowNumber, $cell);
            $column++;
        }
        $rowNumber++;
    }

    //Filtres
    $sheet->setCellValue('D1', 'Filtres :');
    $column = 'E';
    foreach ($filters as $filter) {
        $count = 0;
        $sheet->setCellValue($column . '1', $filter . ' : ' . $valueFilters[$filter]);
        $count++;
        $column++;
    }

    // Créer le writer pour CSV
    $writer = new Csv($spreadsheet);
    $writer->setDelimiter(';');
    $filePath = '../../' . $filename;
    $writer->save($filePath);

    echo json_encode(["fileUrl" => "export/download.php?file=" . basename($filePath)]);
}
?>