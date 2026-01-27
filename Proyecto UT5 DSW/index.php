<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>

<?php
//EJEMPLO DE USO

require_once 'clases/Producto.php';
require_once 'clases/Llavero.php';
require_once 'clases/Paquete.php';
require_once 'clases/PaqueteLlaves.php';
require_once 'clases/PaqueteBolso.php';
require_once 'clases/PaqueteMochila.php';

// 1️⃣ Crear productos (llaveros)
$llaveroLlaves   = new Llavero("Llavero llaves", 5.00, "llaves");
$llaveroBolso    = new Llavero("Llavero bolso", 7.50, "bolso");
$llaveroMochila  = new Llavero("Llavero mochila", 6.00, "mochila");

// 2️⃣ Crear paquetes
$paqueteLlaves   = new PaqueteLlaves($llaveroLlaves, 3);
$paqueteBolso    = new PaqueteBolso($llaveroBolso, 2);
$paqueteMochila  = new PaqueteMochila($llaveroMochila, 4);

// 3️⃣ Mostrar resultados
echo "<h2>Resultado de la compra</h2>";

echo "<p>Paquete llaves:</p>";
echo "<ul>";
echo "<li>Producto: " . $llaveroLlaves->getNombre() . "</li>";
echo "<li>Cantidad: 3</li>";
echo "<li>Importe total: " . $paqueteLlaves->getImporteTotal() . " €</li>";
echo "</ul>";

echo "<p>Paquete bolso:</p>";
echo "<ul>";
echo "<li>Producto: " . $llaveroBolso->getNombre() . "</li>";
echo "<li>Cantidad: 2</li>";
echo "<li>Importe total: " . $paqueteBolso->getImporteTotal() . " €</li>";
echo "</ul>";

echo "<p>Paquete mochila:</p>";
echo "<ul>";
echo "<li>Producto: " . $llaveroMochila->getNombre() . "</li>";
echo "<li>Cantidad: 4</li>";
echo "<li>Importe total: " . $paqueteMochila->getImporteTotal() . " €</li>";
echo "</ul>";

// 4️⃣ Totales por tipo (como pide el enunciado)
$totalLlaves   = $paqueteLlaves->getImporteTotal();
$totalBolso    = $paqueteBolso->getImporteTotal();
$totalMochila  = $paqueteMochila->getImporteTotal();

echo "<h3>Totales</h3>";
echo "<p>Total llaves: $totalLlaves €</p>";
echo "<p>Total bolso: $totalBolso €</p>";
echo "<p>Total mochila: $totalMochila €</p>";




