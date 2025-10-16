<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    /* estilos para el formulario */
    .texto{
        width: 300px;
        height: 100px;
        margin-top: 10px;
        margin-bottom: 10px;
        font-size: 20px;
        font-weight: bold;
 
    }
    .enviar{
        height: 30px;
        width: 100px;
        margin-top: 10px;
        margin-bottom: 10px;
        background-color: lightblue;
        border-radius: 10px;
    }
</style>

<!-- se realiza un formulario que pida un texto y 
 al enviarlo debe mostrar un mensaje que diga: [nombre random] saca al perro. -->
 
<body>
<form method="post">
    <label for="texto" class="texto">Ingrese un texto:</label>
<textarea name="texto" placeholder="Ingrese su texto" ></textarea>
<input type="submit" value="Enviar" class="enviar">
</form>

<?php
/* se realiza el php que procese el formulario y se utiliza preg_split para separar las palabras */
$nombre = preg_split( "/[\s,]+/", $_POST['texto']);

$numeros_para_printear = rand(0, count($nombre)-1);
/* se muestra el mensaje */
    echo "$nombre[$numeros_para_printear] saca al perro. <br>";




?>  
</body>
</html>