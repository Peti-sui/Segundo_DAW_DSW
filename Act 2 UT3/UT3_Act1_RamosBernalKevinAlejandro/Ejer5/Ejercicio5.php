<?php
/* iniciar sesion */
session_start();
$mensaje = "";

/* login */
if (isset($_POST["login"])) {
    $usuario = $_POST["usuario"] ?? "";
    $clave = $_POST["clave"] ?? "";

    if ($usuario == "admin" && $clave == "admin123") {
        $_SESSION["usuario"] = $usuario;
        $_SESSION["rol"] = "Administrador";
        header("Location:bienvenida.php");
        exit();
    } elseif ($clave == "user123") {
        $_SESSION["usuario"] = $usuario;
        $_SESSION["rol"] = "Usuario";
        header("Location:bienvenida.php");
        exit();
    } else {
        $mensaje = "Usuario o clave incorrecta";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5</title>
</head>

<body>
    <?php if ($mensaje != "")
        echo "<p><b>$mensaje</b></p>"; ?>
    <form method="post">
        <label>Usuario
            <input type="text" name="usuario" required>
        </label>
        <label>Clave
            <input type="password" name="clave" required>
        </label>
        <button type="submit" name="login">Entrar</button>
    </form>
</body>

</html>