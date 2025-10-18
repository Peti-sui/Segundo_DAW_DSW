<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>documento</title>
    <style>
        /* estilo general del body */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f5f5, #dfe9f3);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
            min-height: 100vh;
        }

        /* estilo del formulario */
        form {
            background-color: #fff;
            padding: 25px 35px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            margin-bottom: 20px;
            text-align: center;
            transition: transform 0.2s;
        }

        /* efecto sutil al pasar el mouse sobre el formulario */
        form:hover {
            transform: translateY(-5px);
        }

        /* estilo del input tipo file */
        input[type="file"] {
            margin: 15px 0;
            cursor: pointer;
        }

        /* estilo del boton */
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.2s;
        }

        /* efecto hover del boton */
        button:hover {
            background-color: #0056b3;
        }

        /* estilo de los mensajes de error */
        .errores {
            background-color: #ffe6e6;
            color: #cc0000;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            max-width: 400px;
            text-align: left;
        }

        /* estilo de la imagen optimizada */
        img {
            max-width: 400px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            margin-top: 15px;
        }

        /* etiqueta del formulario */
        label.texto {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>

<?php
/* inicializacion de variables */
$imagen_subida = '';
$errores = [];

/* comprobacion de envio del formulario */
if($_SERVER['REQUEST_METHOD'] == "POST"){

    /* verificacion de archivo subido sin errores */
    if(isset($_FILES['imagen_opti']) && $_FILES['imagen_opti']['error'] == 0 ){

        /* directorio de subida */
        $dir_subida = './img_optizar/';
        if(!is_dir($dir_subida)){
            mkdir($dir_subida, 0777, true);
        }

        $imagen_subida = $dir_subida . basename($_FILES['imagen_opti']['name']);
        $tipo = mime_content_type($_FILES['imagen_opti']['tmp_name']);

        /* verificamos que sea una imagen valida */
        if(strpos($tipo, 'image/') === 0){
            move_uploaded_file($_FILES['imagen_opti']['tmp_name'], $imagen_subida);

            /* aplicamos filtro de escala de grises */
            $img = imagecreatefromstring(file_get_contents($imagen_subida));
            imagefilter($img, IMG_FILTER_GRAYSCALE);
            imagejpeg($img, $imagen_subida);
            imagedestroy($img);
        } else {
            $errores [] = "el archivo no es una imagen valida";
        }
    }
}
?>

<body>

<!-- formulario de subida de imagen -->
<form method="post" enctype="multipart/form-data">
    <label for="file" class="texto">introduzca una imagen a optimizar</label>
    <input type="file" name="imagen_opti">
    <button type="submit">optimizar</button>
</form>

<?php
/* mostrar errores si existen */
if (!empty($errores)) {
    echo "<div class='errores'><h3>errores:</h3>";
    foreach ($errores as $error) {
        echo "<p>$error</p>";
    }
    echo "</div>";
}

/* mostrar imagen optimizada si existe */
if($imagen_subida){
    echo "<img src='$imagen_subida' alt='imagen optimizada'>";
}
?>

</body>
</html>
