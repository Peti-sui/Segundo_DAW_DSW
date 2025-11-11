<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad3_UT3</title>
</head>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuarioFinal = 'Castor';
    $contraFinal = '1234';

    $usuario = isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] :null;
    $contra = isset($_REQUEST['contra']) ? $_REQUEST['contra'] :null;

    if($usuarioFinal == $usuario && $contraFinal == $contra){
        session_start();
        $_SESSION['usuario'] = $_REQUEST['usuario'];

        header('Location: ./bienvenida.php');
        die();
    }else{
        echo "Usuario o contraseña incorrectos";
    }

}

?>
<body>

<form method="post" action="">

    <h3>Introduzca datos para el inicio de sesion</h3>
    <label for="usuario">Nombre de usuario:</label>
    <input type="text" name="usuario" placeholder="Ej: Pedro" required>
    <br>
    <label for="contra">Contraseña:</label>
    <input type="password" name="contra" placeholder="********" required>
    <br>
    <button type="submit">Iniciar sesión</button>

</form>
    
</body>
</html>