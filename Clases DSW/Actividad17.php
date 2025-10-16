<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IVA</title>
</head>
<body>

<h2>Calculadora de IVA</h2>

<!-- 
    Formulario para capturar el precio ingresado por el usuario.
    El método POST se utiliza para enviar los datos de forma segura.
-->
<form method="post">
    <label for="precio">Ingrese el precio con IVA incluido:</label>
    <input type="number" name="precio" id="precio" placeholder="Ej: 121.00">
    <input type="submit" value="Calcular">
</form>

<?php
/* 
    Verificamos si el formulario fue enviado usando el método POST.
    Esto evita ejecutar el cálculo antes de que el usuario envíe un valor.
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtenemos el precio ingresado y eliminamos espacios innecesarios.
    $precioConIVA = trim($_POST['precio']);

    // Validamos que el campo no esté vacío y que sea numérico.
    if ($precioConIVA === '' || !is_numeric($precioConIVA) || $precioConIVA <= 0) {
        echo "<p style='color:red;'>Por favor, ingrese un precio válido mayor a 0.</p>";
    } else {
        /* 
            Fórmula para calcular el precio sin IVA:
            Se asume que el precio ingresado ya incluye el 21% de IVA.
            Para obtener el precio base: dividir entre 1.21.
        */
        $precioSinIVA = $precioConIVA / 1.21;

        // Calculamos el monto correspondiente al IVA.
        $iva = $precioConIVA - $precioSinIVA;

        // Mostramos los resultados con dos decimales para mayor claridad.
        echo "<h3>Resultados:</h3>";
        echo "<p>Precio sin IVA: " . number_format($precioSinIVA, 2) . " €</p>";
        echo "<p>IVA (21%): " . number_format($iva, 2) . " €</p>";
        echo "<p>Precio total con IVA: " . number_format($precioConIVA, 2) . " €</p>";
    }
}
?>

</body>
</html>
