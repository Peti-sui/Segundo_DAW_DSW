<?php

$errores[] = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nombre = $_POST['nombre'] ?? '';
    $nota = $_POST['nota'] ?? '';
    $color_tabla = $_POST['color_tabla'] ?? 'white';
    $color_letra = $_POST['color_letra'] ?? 'black';

    $nombre_sano = filter_var($nombre, FILTER_SANITIZE_STRING);

    if($nombre_sano == ''){
        $errores[] = 'El nombre no puede estar vacio <br>';
    }



    $nota_sana = filter_var($nota, FILTER_SANITIZE_NUMBER_INT);

    $nota_definitiva = filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_INT);

    if($nota_definitiva === false || $nota_definitiva < 0 || $nota_definitiva > 10){
        $errores[] = 'La nota debe cumplir con el estandar de 0 a 10 <br>';

    }

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica</title>
</head>

<body>
    <form method="post">
        <input type="text" name="nombre" placeholder="Introduce nombre">
        <br>
        <input type="number" name="nota" placeholder="Introduce nota">
        <br>
        <label for="color_tabla">La tabla de que color?</label>
        <input type="color" name="color_tabla">
        <br>
        <label for="color_letra">La letra de que color?</label>
        <input type="color" name="color_letra">
        <br>
        <button type="submit" name="enviar">Enviar</button>
    </form>
</body>

<?php

foreach($errores as $error){
    echo "$error";

}
?>

<?php

echo "<table border='1' style='background-color: $color_tabla; color: $color_letra;'>";"
    <tr>
        <th>Nombre</th>
        <th>Nota</th>
    </tr>
    <tr>
        <td>$nombre_sano</td>
        <td>$nota_definitiva</td>
    </tr>
</table>";
?>

</html>