<?php
    session_start();
    require '../vendor/autoload.php'; // Asegúrate de tener autoload.php después de instalar PhpSpreadsheet

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $documento = $_POST['documento'];
    $contrasena = $_POST['contrasena'];
    $es_veterinario = isset($_POST['es_veterinario']) ? 1 : 0; // Si está marcado, será 1; si no, será 0

    $excelPath = '../usuarios.xlsx'; // Ruta al archivo Excel

    try {
        // Verificar que el correo no se repita en el Excel
        $spreadsheet = new Spreadsheet();
        if (file_exists($excelPath)) {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelPath);
        }

        $sheet = $spreadsheet->getActiveSheet();
    
        foreach ($sheet->getRowIterator() as $row) {
            $fila = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
        
            foreach ($cellIterator as $cell) {
                $fila[] = $cell->getValue();
            }
        
            // Comparar el correo actual con el ingresado para verificar duplicados
            if ($fila[2] == $correo){
                echo '
                    <script>
                        alert("Este correo ya está registrado, intenta con otro diferente");
                        window.location = "../index.php";
                    </script>
                ';
                exit();
            }
            if ($fila[0] == $documento){
                echo '
                    <script>
                        alert("Este documento ya está registrado, intenta con otro diferente");
                        window.location = "../index.php";
                    </script>
                ';
                exit();
            }

        }

        // Obtener la última fila en el archivo Excel
        $lastRow = $sheet->getHighestRow() + 1;

        // Escribir los datos en la nueva fila
        $sheet->setCellValue('B'.$lastRow, $nombre_completo);
        $sheet->setCellValue('C'.$lastRow, $correo);
        $sheet->setCellValue('A'.$lastRow, $documento);
        $sheet->setCellValue('D'.$lastRow, $contrasena);
        $sheet->setCellValue('E'.$lastRow, $es_veterinario);

        // Guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save($excelPath);

        $_SESSION['usuario'] = $documento;

        // Mostrar mensaje de éxito y redirigir
        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                ';

        if ($es_veterinario == 1) {
            echo 'window.location = "../inicioVeterinario.php";';
        } else {
            echo 'window.location = "../inicioUsuario.php";';
        }

        echo '
            </script>
        ';

    } catch (Exception $e) {
        // Mostrar mensaje de error si ocurre alguna excepción
        echo '
            <script>
                alert("Error al almacenar el usuario. Inténtelo de nuevo más tarde.");
                window.location = "../index.php";
            </script>
        ';
    }
?>
