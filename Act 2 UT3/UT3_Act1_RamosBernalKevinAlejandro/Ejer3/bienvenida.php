<?php
session_start();

/* Comprobar si hay sesion */
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

/* Boton para cerrar sesion */
if (isset($_POST["cerrar"])) {
    session_destroy();
    header("Location: Ejercicio3.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
</head>

<body>
    <h1>Bienvenido <?php echo $_SESSION["usuario"]; ?></h1>
    <form method="post">
        <button type="submit" name="cerrar">Cerrar sesion</button>
    </form>
</body>

</html>