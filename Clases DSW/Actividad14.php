<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    si se da a enviar se quita el error
    <!-- se realiza un formulario que pida nombre, numero de telefono, email y mensaje. Al enviarlo debe mostrar un mensaje que diga:
    Hola [nombre]! Te voy a enviar spam a [email] y te llamaré por la madrugada a [numero]. [mensaje] Enviado desde un iPhone -->
<form method="post">
    <label for="numero">Ingrese un numero:</label>
    <input name="nombre" type="text" placeholder="Ingrese su nombre">
    <input type="number" name="numero" placeholder="Ingrese numero telefono">
    <input type="email" name="email" placeholder="Ingrese su email">
    <input name="mensaje" type="text" placeholder="Ingrese su mensaje">
    <input type="submit" value="Enviar">
</form>

<!-- se realiza el php que procese el formulario -->
<?php
    $nombre = $_REQUEST['nombre'] ? $_REQUEST['nombre'] : '';
    $numero = $_REQUEST['numero'] ? $_REQUEST['numero'] : '';
    $email = $_REQUEST['email'] ? $_REQUEST['email'] : '';
    $mensaje = $_REQUEST['mensaje'] ? $_REQUEST['mensaje'] : '';

    /* se muestra el mensaje */

echo "<br>";
echo "Hola $nombre!";
echo "<br>";
echo "Te voy a enviar spam a $email y te llamaré por la madrugada a $numero.";
echo "<br>";
echo "$mensaje";
echo "<br>";
echo "Enviado desde un iPhone";

?>
    
</body>
</html>