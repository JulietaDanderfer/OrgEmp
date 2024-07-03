<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
        echo'
            <script>
                alert("Debes iniciar sesión");
                window.location = "index.php";
            </script>
        ';
        session_destroy();
        die();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO</title>
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilosInicio.css">
</head>
<body>

    <main>

        <h1> Inicio Veterinario</h1>

        <div class="container__box">
            <div class="box">
                <i class="lni lni-upload"></i>
                <h5>Agregar Mascota</h5>
                <h4>Agregar Mascota</h4>
            </div>
            <div class="box">
                <i class="lni lni-download"></i>
                <h5>Dar de baja Mascota</h5>
                <h4>Dar de baja Mascota</h4>
            </div>
            <div class="box">
                <i class="lni lni-files"></i>
                <h5>Ver mis pacientes</h5>
                <h4>Ver mis pacientes</h4>
            </div>
            <a href="php/cerrar_sesion.php" style="text-decoration: none;">
                <div class="box">
                    <i class="lni lni-exit"></i>
                    <h5>Cerrar Sesion</h5>
                    <h4>Cerrar Sesion</h4>
                </div>
            </a>
            <a href="https://www.google.com/maps/search/veterinarias+en+tandil/@-37.3150442,-59.11657,16z?entry=ttu" style="text-decoration: none;">
                <div class="box">
                    <i class="lni lni-map-marker"></i>
                    <h5>Veterinarias</h5>
                    <h4>Veterinarias</h4>
                </div>
            </a>
            <div class="box">
                <i class="lni lni-cog"></i>
                <h5>Configuracion</h5>
                <h4>Configuracion</h4>
            </div>
            <div class="box">
                <i class="lni lni-support"></i>
                <h5>Soporte</h5>
                <h4>Soporte</h4>
            </div>
            <div class="box">
                <i class="lni lni-users"></i>
                <h5>Contacto</h5>
                <h4>Contacto</h4>
            </div>
        </div>

    </main>
    
</body>
</html>