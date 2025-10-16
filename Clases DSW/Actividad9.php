<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

/* pone los numeros del 1 al 10, del 60 al 70, del 20 al 1, 
los numeros pares del 1 al 1000, la tabla del 5 y la suma de los numeros del 1 al 100 */
echo "Numeros del 1 al 10 <br>";

foreach (range(1, 10) as $numero) {
  echo "$numero <br>";
}

echo "<br>Numeros del 60 al 70 <br>";

foreach (range(60, 70) as $numero) {
  echo "$numero <br>";
}

echo "<br>Numeros del 20 al 1 <br>";

foreach (range(20, 1) as $numero) {
  echo "$numero <br>";
}

echo "<br>Numeros pares del 1 al 1000 <br>";

foreach (range(1, 1000) as $numero) {
  if ($numero % 2 == 0) {
    echo "$numero <br>";
  }
}

echo "La tabla del 5 <br>";

foreach (range(1, 10) as $numero) {
  $resultado = $numero * 5;
  echo "5 x $numero = $resultado <br>";
}

echo "La suma de los numeros del 1 al 100 es: <br>";

$suma = 0;
foreach (range(1, 100) as $numero) {
  $suma += $numero;
  echo "Este es el numero sumado por cada vuelta: $suma <br>";
}







?>
    
</body>
</html>