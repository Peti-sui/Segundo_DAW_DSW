<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>

body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        form {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 300px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="file"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form input[type="submit"] {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            border: none;
            background-color: #3897f0;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        .tarjeta {
            width: 300px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .tarjeta img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #3897f0;
        }

        .tarjeta h1 {
            margin: 5px 0;
            font-size: 22px;
        }

        .tarjeta h3 {
            margin: 5px 0;
            font-weight: normal;
            color: #555;
        }


</style>

<?php
$apodo = '';
$edad = '';
$imagen_subida = '';

if($_SERVER['REQUEST_METHOD'] == "POST") {
if(!empty($_POST['apodo']) && !empty($_POST['edad']) && isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] == 0){
     $apodo = isset($_POST['apodo']) ? $_POST['apodo'] : '';
      $edad = isset($_POST['edad']) ? $_POST['edad'] : '';

      
$dir_subida = './perfil_img/';

$imagen_subida = $dir_subida . basename($_FILES['imagen_perfil']['name']);

$tipo = mime_content_type($_FILES['imagen_perfil']['tmp_name']);

if(strpos($tipo, 'image/') === 0){
    move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $imagen_subida);
} else {
    echo "<p>El archivo no es una imagen valida.</p>";
}

    }
}

?>

<body>
    <form method="post" enctype="multipart/form-data">
        <label for="texto" class="texto">Ingrese un apodo:</label>
        <input type="text" name="apodo" placeholder="Escriba el apodo...">
        
        <label for="texto" class="texto">Ingrese una edad:</label>
        <input type="number" name="edad" placeholder="Introduzca la edad...">
        
        <label for="texto" class="texto">Introduzca una imagen de perfil</label>
        <input type="file" name="imagen_perfil">
        
        <input type="submit" value="enviar">
    </form>
</body>

<?php


echo "<div class='tarjeta'>
        <h1>Usuario: $apodo</h1>
        <h3>Edad: $edad años</h3>
        <img src='$imagen_subida'>
      </div>";


?>

</html>