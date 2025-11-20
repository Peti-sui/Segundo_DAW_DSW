<?php
session_start();

/* Comprobar si se envia el formulario */
if (isset($_POST["login"])) {
    $usuario = $_POST["usuario"] ?? "";
    $contra = $_POST["contra"] ?? "";

    if ($usuario == "admin" && $contra == "1234") {
        $_SESSION["usuario"] = $usuario;
        header("Location: bienvenida.php");
        exit;
    } else {
        $mensaje = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <?php if (isset($mensaje))
        echo "<p>$mensaje</p>"; ?>
    <form method="post">
        <label>Usuario: <input type="text" name="usuario" required></label><br>
        <label>Contraseña: <input type="password" name="contra" required></label><br>
        <button type="submit" name="login">Iniciar sesion</button>
    </form>
</body>

</html>