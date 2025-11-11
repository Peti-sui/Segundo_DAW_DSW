<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidooo</title>
</head>
<?php
session_start();

if (!isset($_SESSION['usuario'])){
    header('Location: ./Actividad3_UT3.php');
    die();
}
?>

<body>

    <h1>¡Bienvenido a la página de bienvenida!</h1>
    <a href="./logout.php">Cerrar sesión</a>



    
</body>
</html>