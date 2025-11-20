<?php



/* Crear cookie */
if (isset($_POST["crear"])) {
    $mensaje = "";
    $comprobar = "";
    $destruir = "";

    $tiempo = $_POST["tiempo"] ?? 0;

    if ($tiempo >= 1 && $tiempo <= 60) {
        setcookie("galleta", $_REQUEST['comprobar'], time() + $tiempo);

        $mensaje = " Cookie creada,  con una duracion de $tiempo segundos...";
    } else {
        $mensaje = " El tiempo debe estar entre 1 y 60 segundos :( ";
    }
}


/* Comprobar cookie */
if (isset($_POST["comprobar"])) {
    if (isset($_COOKIE["galleta"])) {
        $mensaje = " La cookie esta existente :) ";
    } else {
        $mensaje = " La cookie no esta por ningun lado :( [ habra que crearla ] ";
    }

}

/* Destruir cookie */
if (isset($_POST["destruir"])) {
    if (isset($_COOKIE["galleta"])) {
        setcookie("galleta", "", time() - 60);
        $mensaje = " Cookie destruida correctamente :) ";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <form method="post">
        <?php
        if (isset($_POST["comprobar"]) || isset($_POST["crear"])) {

            echo "<p><b>$mensaje</b></p>";
        }

        if (isset($_POST["destruir"])) {

            echo "<p><b>$mensaje</b></p>";
        }
        ?>
        <label for="tiempo">Crear una cookie con una duracion de
            <input type="number" name="tiempo"> segundos (entre 1 y 60) [predeterminado 10 sec]</label>
        <button type="submit" name="crear">Crear</button>
        <br>
        <label for="comprobar">Comprobar la cookie
            <button type="submit" name="comprobar">Comprobar</button></label>
        <br>
        <label for="destruir">Destruir la cookie
            <button type="submit" name="destruir">destruir</button></label>
    </form>

</body>

</html>