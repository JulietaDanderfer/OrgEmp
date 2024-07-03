<?php

    session_start();
    require '../vendor/autoload.php'; // Asegúrate de tener autoload.php después de instalar PhpSpreadsheet
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $documento = $_POST['documento'];
    $contrasena = $_POST['contrasena'];

    // Cargar el archivo Excel
    $spreadsheet = IOFactory::load('../usuarios.xlsx');
    $worksheet = $spreadsheet->getActiveSheet();

    // Recorrer las filas del archivo Excel
    $validar_login = false;
    $veterinario = 0;
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

        //la columna A es documento, la D es contraseña, y la E es veterinario
        if ($fila[0] == $documento && $fila[3] == $contrasena) {
            $validar_login = true;
            $veterinario = $fila[4];
            break;
        }
    }

    if ($validar_login) {
        $_SESSION['usuario'] = $documento;
        if ($veterinario == 1) {
            header("Location: ../inicioVeterinario.php");
        } else {
            header("Location: ../inicioUsuario.php");
        }
        exit();
    } else {
        echo '
            <script>
                alert("Datos erroneos");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }
?>
