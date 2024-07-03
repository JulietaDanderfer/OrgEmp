<?php

    session_start();
    require 'vendor/autoload.php'; // Asegúrate de tener autoload.php después de instalar PhpSpreadsheet

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $raza = $_POST['raza'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $peso = $_POST['peso'];

    $excelPath = 'mascotas.xlsx'; // Ruta al archivo Excel

    try {

        $documento_tutor = $_SESSION['usuario'];
        $spreadsheet = IOFactory::load('mascotas.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $id = 0;
        $firstRow = true;

        foreach ($worksheet->getRowIterator() as $row) {
            if ($firstRow) {
                $firstRow = false;
                continue; // Saltar la primera fila (encabezados)
            }

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $fila = [];

            foreach ($cellIterator as $cell) {
                $fila[] = $cell->getValue();
            }

            if ($fila[1] == $documento_tutor) {
                $id = $fila[0];
            }
        }

        $id = $id + 1;

        $spreadsheet = new Spreadsheet();
        if (file_exists($excelPath)) {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelPath);
        }

        $sheet = $spreadsheet->getActiveSheet();

        // Obtener la última fila en el archivo Excel
        $lastRow = $sheet->getHighestRow() + 1;
        
        // Escribir los datos en la nueva fila
        $sheet->setCellValue('A'.$lastRow, $id);
        $sheet->setCellValue('B'.$lastRow, $documento_tutor);
        $sheet->setCellValue('C'.$lastRow, 0);
        $sheet->setCellValue('D'.$lastRow, $nombre);
        $sheet->setCellValue('E'.$lastRow, $especie);
        $sheet->setCellValue('F'.$lastRow, $raza);
        $sheet->setCellValue('G'.$lastRow, $fecha_nacimiento);
        $sheet->setCellValue('H'.$lastRow, $peso);

        // Guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save($excelPath);

        echo '
            <script>
                alert("Mascota registrada exitosamente!");
                window.location = "inicioUsuario.php";
            </script>
        ';

    } catch (Exception $e) {
        // Mostrar mensaje de error si ocurre alguna excepción
        echo '
            <script>
                alert("Error al registrar a la mascota. Inténtelo de nuevo más tarde.");
                window.location = "../index.php";
            </script>
        ';
    }
?>
