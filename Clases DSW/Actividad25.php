<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>document</title>

    <style>
        /* estilo basico y limpio para la pagina */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }

        form {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 15px 25px;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-left: -8px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }

        input[type="submit"] {
            margin-top: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .errores {
            background-color: #ffe5e5;
            border: 1px solid #ff7b7b;
            padding: 10px;
            margin-top: 20px;
            border-radius: 8px;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ccc;
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #eaeaea;
        }

        img {
            border-radius: 5px;
        }
    </style>
</head>

<?php

    /* inicializacion de variables */
    $contra1 = '';
    $contra2 = '';
    $tipo = '';
    $precio = '';
    $errores = [];
    $productos = [];

    /* comprobacion del envio del formulario */
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        /* recuperacion de productos anteriores */
        if(!empty($_POST['productos'])){
            $productos = json_decode($_POST['productos'], true);
        }

        /* validacion de campos requeridos */
        if(!empty($_POST['num_serie']) && !empty($_POST['nombre']) && !empty($_POST['contra1'])
        && !empty($_POST['contra2']) && isset($_FILES['imagen_product']) && $_FILES['imagen_product']['error'] == 0 ){

            $num_serie = isset($_POST['num_serie']) ? $_POST['num_serie'] : '';
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
            $contra1 = isset($_POST['contra1']) ? $_POST['contra1'] : '';
            $contra2 = isset($_POST['contra2']) ? $_POST['contra2'] : '';

            /* creacion de carpeta para subir imagen si no existe */
            $dir_subida = './img_producto/';
            if(!is_dir($dir_subida)){
                mkdir($dir_subida, 0777, true);
            }

            /* configuracion del archivo subido */
            $imagen_subida = $dir_subida . basename($_FILES['imagen_product']['name']);
            $tipo = mime_content_type($_FILES['imagen_product']['tmp_name']);

            /* validacion de tipo de archivo */
            if(strpos($tipo, 'image/') === 0){
                move_uploaded_file($_FILES['imagen_product']['tmp_name'], $imagen_subida);
            } else {
                $errores [] = "El archivo no es una imagen valida";
            }

            /* validacion de contraseñas */
            if($contra1 === $contra2){
                $productos [] = [
                    'num_serie' => $num_serie,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'imagen' => $imagen_subida
                ];
            } else {
                $errores [] = "Las contraseñas no coinciden.";
            }

        }
    }

?>

<body>

    <!-- formulario principal para registrar productos -->
    <form method="post" enctype="multipart/form-data">
        <label for="texto" class="texto">Ingrese un numero de serie :</label>
        <input type="number" name="num_serie" placeholder="Escriba el numero...">
        
        <label for="texto" class="texto">Ingrese un nombre de producto :</label>
        <input type="text" name="nombre" placeholder="Introduzca el nombre...">

        <label for="texto" class="texto">Ingrese un precio :</label>
        <input type="number" name="precio" placeholder="Escriba el precio...">
        
        <label for="texto" class="texto">Introduzca una imagen del producto </label>
        <input type="file" name="imagen_product">

        <label for="texto" class="texto">Ingrese una contraseña :</label>
        <input type="text" name="contra1" placeholder="....">

        <label for="texto" class="texto">Ingresela de nuevo :</label>
        <input type="text" name="contra2" placeholder="....">

        <input type="hidden" name="productos" value='<?php echo json_encode($productos);?>'>
        
        <input type="submit" value="enviar">
    </form>

</body>

<?php

    /* muestra de errores si los hay */
    if (!empty($errores)) {
        echo "<div class='errores'><h3>Errores:</h3>";
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }

    /* generacion de tabla de productos */
    if ($contra1 === $contra2 && strpos($tipo, 'image/') === 0) {
        echo "<h2 style='text-align:center;'>Tabla de Productos</h2>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Numero de Serie</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Imagen</th>
              </tr>";

        foreach ($productos as $producto) {
            echo "<tr>";
            echo "<td>" . $producto['num_serie'] . "</td>";
            echo "<td>" . $producto['nombre'] . "</td>";
            echo "<td>" . $producto['precio'] . "</td>";
            echo "<td><img src='" . $producto['imagen'] . "' width='100'></td>";
            echo "</tr>";
        }

        echo "</table>";
    }

?>

</html>
