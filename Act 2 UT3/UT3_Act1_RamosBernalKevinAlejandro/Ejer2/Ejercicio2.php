<?php
/* Si se envia el formulario */
if (isset($_POST["guardar"])) {
    setcookie("nombre", $_POST["nombre"], time() + 86400);
    setcookie("apellido", $_POST["apellido"], time() + 86400);
    $mensaje = "Datos guardados en cookies";
}

/* Leer cookies si existen */
$nombre = $_COOKIE["nombre"] ?? "";
$apellido = $_COOKIE["apellido"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
</head>

<body>

    <?php
    /* Mostrar mensaje de bienvenida o formulario */
    if ($nombre && $apellido) {
        echo "<h1>Bienvenido $nombre $apellido</h1>";
    } else {
        echo "<p>Rellene el formulario para guardar su nombre y apellido</p>";
    }
    ?>

    <form method="post">
        <label>Nombre: <input type="text" name="nombre" required></label><br>
        <label>Apellido: <input type="text" name="apellido" required></label><br>
        <button type="submit" name="guardar">Guardar</button>
    </form>

</body>

</html>