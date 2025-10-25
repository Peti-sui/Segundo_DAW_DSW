<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #f0f4c3, #e6ee9c);
        display: flex;
        justify-content: center;
        padding: 30px 0;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    ul, table {
        width: 400px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 20px;
        margin: 10px auto;
    }

    li, td, th {
        padding: 10px;
        color: #444;
    }

    li {
        border-bottom: 1px solid #eee;
    }

    li:last-child {
        border-bottom: none;
    }

    table th {
        background-color: #8bc34a;
        color: white;
        text-align: left;
    }

    table tr:nth-child(even) td {
        background-color: #f9fbe7;
    }

    .errores {
        background-color: #ffcdd2;
        color: #c62828;
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        width: 400px;
        margin: 20px auto;
    }

    img {
        width: 100px;
        border-radius: 8px;
        box-shadow: 0 0 6px rgba(0,0,0,0.1);
        margin-top: 6px;
    }
</style>

</head>
<body>
<?php
/* Inicializacion de variables y array de errores */
$errores = [];
$nombre = '';
$apellido1 = '';
$apellido2 = '';
$telefono = '';
$correo = '';
$contra1 = '';
$contra2 = '';

/* Comprobacion del metodo de envio del formulario */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    /* Validacion del campo foto y control de errores en la subida */
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {

        /* Sanitizacion y validacion de cada campo del formulario */
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($nombre === null || $nombre === false || $nombre === '') {
            $errores[] = "El nombre no es valido";
        }

        $apellido1 = filter_input(INPUT_POST, 'apellido1', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($apellido1 === null || $apellido1 === false || $apellido1 === '') {
            $errores[] = "El primer apellido no es valido";
        }

        $apellido2 = filter_input(INPUT_POST, 'apellido2', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($apellido2 === null || $apellido2 === false || $apellido2 === '') {
            $errores[] = "El segundo apellido no es valido";
        }

        $telefono = filter_input(INPUT_POST, 'tel', FILTER_VALIDATE_INT);
        if ($telefono === false) {
            $errores[] = "El telefono no es valido";
        }

        $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
        if ($correo === false) {
            $errores[] = "El correo no es valido";
        }

        /* Verificacion del tipo de archivo y guardado en carpeta fotos */
        $fotos_dir = './fotos/';
        if (!is_dir($fotos_dir)) {
            mkdir($fotos_dir, 0777, true);
        }
        $imagen_subir = $fotos_dir . basename($_FILES['foto']['name']);
        $tipo = mime_content_type($_FILES['foto']['tmp_name']);
        if (strpos($tipo, 'image/') === 0) {
            move_uploaded_file($_FILES['foto']['tmp_name'], $imagen_subir);
        } else {
            $errores[] = "El archivo no es una imagen valida";
        }

        /* Comprobacion de contrasenas */
        $contra1 = filter_input(INPUT_POST, 'contra1', FILTER_UNSAFE_RAW);
        $contra2 = filter_input(INPUT_POST, 'contra2', FILTER_UNSAFE_RAW);
        if ($contra1 === null || $contra2 === null || $contra1 === '' || $contra2 === '' || $contra1 !== $contra2) {
            $errores[] = "Las contrasenas no coinciden o son invalidas";
        }

    } else {
        $errores[] = "Error al subir la imagen";
    }
}

/* Mostrar resultado segun validaciones */
if (!empty($errores)) {
    echo "<h2>Errores detectados:</h2><ul>";
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
} else {
    echo "<h2>Datos del usuario registrado:</h2>";
    echo "<ul>";
    echo "<li>Nombre: $nombre</li>";
    echo "<li>Primer apellido: $apellido1</li>";
    echo "<li>Segundo apellido: $apellido2</li>";
    echo "<li>Telefono: $telefono</li>";
    echo "<li>Correo: $correo</li>";
    echo "<li>Foto: <img src='" . $imagen_subir . "' width='250'></li>";
    echo "</ul>";
}
?>
</body>
</html>
