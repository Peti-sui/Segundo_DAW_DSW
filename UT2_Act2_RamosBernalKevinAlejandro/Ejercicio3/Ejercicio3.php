<?php
require_once 'Agenda.php';
require_once 'Contacto.php';

$agenda = new Agenda('./guardados/datos.txt');
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $email = trim($_POST['email'] ?? '');

    try {
        if ($nombre === '') {
            $mensaje = "El nombre no puede estar vacio";
        } else {
            $existente = $agenda->buscarPorNombre($nombre);

            if ($existente === null) {
                if ($telefono !== '' || $email !== '') {
                    $nuevo = new Contacto($nombre, $telefono, $email);
                    $agenda->agregar($nuevo);
                    $mensaje = "Contacto agregado correctamente";
                } else {
                    $mensaje = "Debe ingresar telefono o email para agregar un nuevo contacto";
                }
            } else {
                if ($telefono === '' && $email === '') {
                    $agenda->eliminar($nombre);
                    $mensaje = "Contacto eliminado correctamente";
                } else {
                    $agenda->actualizar($nombre, $telefono, $email);
                    $mensaje = "Contacto actualizado correctamente";
                }
            }
        }
    } catch (Exception $e) {
        $mensaje = "Error: " . $e->getMessage();
    }
}

$contactos = $agenda->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ejercicio3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 { margin-top: 25px; }
        table {
            border-collapse: collapse;
            margin-top: 20px;
            width: 90%;
            max-width: 600px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) { background: #f9f9f9; }
        form {
            background: #fff;
            padding: 20px;
            margin-top: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 500px;
        }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input[type="text"], input[type="email"], input[type="tel"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover { background: #0056b3; }
        .mensaje {
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Agenda Personal</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="mensaje"><?= $mensaje ?></div>
    <?php endif; ?>

    <?php if (!empty($contactos)): ?>
        <table>
            <tr><th>Nombre</th><th>Telefono</th><th>Email</th></tr>
            <?php foreach ($contactos as $c): ?>
                <tr>
                    <td><?= $c->nombre ?></td>
                    <td><?= $c->telefono ?></td>
                    <td><?= $c->email ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay contactos registrados</p>
    <?php endif; ?>

    <form method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Telefono:</label>
        <input type="tel" name="telefono">

        <label>Email:</label>
        <input type="email" name="email">

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
