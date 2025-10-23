<?php

$errores = [];
$nombre = $apellido1 = $apellido2 = $mes = $dia = $anio = $direccion = $documentoIdentidad = $ciudad = $pais = $email = $numero = $recibir = $sexo = '';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    if ($nombre === null || $nombre === '') {
        $errores[] = "el campo nombre es obligatorio";
    }

    $apellido1 = filter_input(INPUT_POST, 'apellido1', FILTER_SANITIZE_STRING);
    if ($apellido1 === null || $apellido1 === '') {
        $errores[] = "el campo primer apellido es obligatorio";
    }

    $apellido2 = filter_input(INPUT_POST, 'apellido2', FILTER_SANITIZE_STRING);
    if ($apellido2 === false) {
        $errores[] = "el campo segundo apellido no es valido";
    }

    $mes = filter_input(INPUT_POST, 'mes', FILTER_SANITIZE_STRING);


if ($mes === null || trim($mes) === '' || strtolower($mes) === 'seleccione el mes') {
    $mes = 'no seleccionado';
    $errores[] = "el mes no ha sido seleccionado";
}

    $dia = filter_input(INPUT_POST, 'dia', FILTER_VALIDATE_INT);
    if ($dia === false || $dia < 1 || $dia > 31) {
        $errores[] = "el dia ingresado no es valido";
    }

    $anio = filter_input(INPUT_POST, 'anio', FILTER_VALIDATE_INT);
    if ($anio === false || $anio < 1900 || $anio > date("Y")) {
        $errores[] = "el año ingresado no es valido";
    }

    $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
    if ($direccion === false) {
        $errores[] = "la direccion no es valida";
    }

    $documentoIdentidad = filter_input(INPUT_POST, 'documentoIdentidad', FILTER_SANITIZE_STRING);
    if ($documentoIdentidad === null || $documentoIdentidad === '') {
        $errores[] = "el documento de identidad es obligatorio";
    }

    $ciudad = filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_STRING);
    if ($ciudad === false) {
        $errores[] = "la ciudad no es valida";
    }

    $pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING);
    if ($pais === false) {
        $errores[] = "el pais no es valido";
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($email === false) {
        $errores[] = "el email no es valido";
    }

    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
    if ($numero === false || strlen($numero) < 6) {
        $errores[] = "el numero telefonico no es valido";
    }

    $recibir = isset($_POST['recibir']) ? 'si' : 'no';

    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
    if ($sexo === null || $sexo === '') {
        $sexo = 'no seleccionado';
    }

    $nombre = str_replace('&', '&amp;', $nombre);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>resultado formulario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 30px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        th, td {
            padding: 15px 20px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
            font-size: 16px;
        }
        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }
        tr td:first-child {
            font-weight: bold;
            width: 35%;
            background-color: #cde5ffff;
        }
        tr td:last-child {
            width: 65%;
        }
        .errores {
            background-color: #ffe6e6;
            color: #cc0000;
            padding: 15px;
            border-radius: 10px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<h2>datos del formulario</h2>

<?php if (!empty($errores)): ?>
    <div class="errores">
        <h3>se encontraron errores:</h3>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <table>
        <tr><th>tipo</th><th>informacion</th></tr>
        <tr><td>nombre</td><td><?php echo $nombre; ?></td></tr>
        <tr><td>primer apellido</td><td><?php echo $apellido1; ?></td></tr>
        <tr><td>segundo apellido</td><td><?php echo $apellido2; ?></td></tr>
        <tr><td>fecha de nacimiento</td><td><?php echo $dia . ' de ' . $mes . ' de ' . $anio; ?></td></tr>
        <tr><td>direccion</td><td><?php echo $direccion; ?></td></tr>
        <tr><td>documento de identidad</td><td><?php echo $documentoIdentidad; ?></td></tr>
        <tr><td>ciudad</td><td><?php echo $ciudad; ?></td></tr>
        <tr><td>pais</td><td><?php echo $pais; ?></td></tr>
        <tr><td>email</td><td><?php echo $email; ?></td></tr>
        <tr><td>telefono</td><td><?php echo $numero; ?></td></tr>
        <tr><td>desea recibir informacion</td><td><?php echo $recibir; ?></td></tr>
        <tr><td>sexo</td><td><?php echo $sexo; ?></td></tr>
    </table>
<?php endif; ?>

</body>
</html>
