<?php
session_start();

$autor = $_SESSION['autor'] ?? '';
$nombre_doc = $_SESSION['nombre_doc'] ?? '';
$imagenes = $_SESSION['imagenes'] ?? [];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>

<body>

<h2>Documentos Registrados</h2>

<table border="1">
    <tr>
        <th>Nombre del documento</th>
        <th>Imagen</th>
    </tr>

    <?php
    // Mostrar cada imagen con su nombre
    foreach ($imagenes as $ruta) {
        echo "
        <tr>
            <td>$nombre_doc</td>
            <td><img src='$ruta' width='150'></td>
        </tr>";
    }
    ?>

</table>

<br><br>

<strong>Autor: <?php echo $autor; ?></strong>

</body>
</html>
