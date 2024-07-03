<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Mascota</title>
    <link rel="stylesheet" href="assets/css/estilosRegistroBajaMascota.css">
</head>
<body>
    <div class="form_content">
        <h2>Registrar Mascota</h2>
        <form action="registrarMascotaUsuario.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <label for="especie">Especie</label>
            <select name="especie" id="especie">
                <option value="perro">perro</option>
                <option value="gato">gato</option>
            </select>
            <label for="raza">Raza</label>
            <input type="text" name="raza" id="raza">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
            <label for="peso">Peso (kg)</label>
            <input type="number" name="peso" id="peso" step="0.25" min="0">
            <input class="btn" type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>