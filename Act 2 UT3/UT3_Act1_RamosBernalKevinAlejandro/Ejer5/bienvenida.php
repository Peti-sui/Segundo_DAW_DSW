<?php
session_start();

/* comprobar si hay sesion iniciada */
if (!isset($_SESSION['usuario'])) {
    header("Location: Ejercicio5.php");
    exit;
}

/* logout */
if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: Ejercicio5.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Página de Bienvenida</title>
</head>

<body>
    <h1>Bienvenido <?php echo $usuario ?></h1>
    <p>Rol: <?php echo $rol ?></p>

    <?php if ($rol === "Administrador"): ?>
        <h3>Zona de Administracion</h3>
        <p>Aqui puedes gestionar el sitio</p>
    <?php endif; ?>

    <form method="post">
        <button type="submit" name="logout">Cerrar Sesion</button>
    </form>
</body>

</html>