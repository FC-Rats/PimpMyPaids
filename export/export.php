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

    if ($filters != NULL) {
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

    if ($filters != NULL) {
        //Filtres
        $sheet->setCellValue('D1', 'Filtres :');
        $column = 'E';

        foreach ($filters as $filter) {
            $count = 0;
            $sheet->setCellValue($column . '1', $filter . ' : ' . $valueFilters[$filter]);
            $count++;
            $column++;
        }
    }

    // Créer le writer pour CSV
    $writer = new Csv($spreadsheet);
    $writer->setDelimiter(';');
    $filePath = '../../' . $filename;
    $writer->save($filePath);

    echo json_encode(["fileUrl" => "export/download.php?file=" . basename($filePath)]);
}

function exportToPdf($filename, $headers, $data, $title, $filters, $valueFilters) {
    $mpdf = new \Mpdf\Mpdf(['tempDir' => '/home/3binf2/chamsedine.amouche/WWW/']);
    $stylesheet = '
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        table, th, td {
            border: 1px solid black;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color : #8E8D8D;
        }

        tr:nth-child(even) td {
            background-color: #D5D4D4;
          }
    ';

    // Date du jour
    $today = date("d/m/Y");

    // Commencer le buffer pour capturer le HTML
    ob_start();

    echo "<h1>" . $title . "</h1>";

    echo "<h2>EXTRAIT DU " . $today . "</h2>";

    
    if ($filters != NULL) {
        echo "<table border='1' style='margin-bottom: 20px;'>";
    
        echo "<tr>";
        foreach ($filters as $filter) {
            echo "<th>" . $filter . " : " . $valueFilters[$filter] . "</th>";
        }

        echo "</tr>";
        echo "</table>";
    }
    
    echo "<table border='1'>";
    
    echo "<tr>";

    foreach ($headers as $header) {
        echo "<th>" . $header . "</th>";
    }
    echo "</tr>";

    foreach ($data as $row) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>" . $cell . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    $html = ob_get_contents();
    ob_end_clean();

    
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    $filePath = '../../' . $filename;
    $mpdf->Output($filePath, \Mpdf\Output\Destination::FILE);

    echo json_encode(["fileUrl" => "export/download.php?file=" . basename($filePath)]);
}
?>