<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

/* crea un select con los dias del 1 al 31 mediante un foreach para poner las opciones */

echo "<h3>Introduce el dia de nacimiento del 1 al 31 : </h3> <br>";

  echo "<select name='dia' id='dia'>" ;

  foreach (range(1, 31) as $dia) {
    echo "<option>$dia</option>";
}

  echo "</select>";

;

/* crea un select con los meses del 1 al 12 mediante un for para poner las opciones */
echo "<h3>Introduce el mes de nacimiento del 1 al 12 : </h3> <br>";

    echo "<select name='mes' id='mes'>" ;
    
    for ($mes = 1; $mes <= 12; $mes++) {
      echo "<option>$mes</option>";
    }

    echo "</select>";

    echo "<h3>Introduce el año de nacimiento del 1900 al 2025 : </h3> <br>";
    echo "<select name='año' id='año'>";

   $año_previo = 1900;

   while ($año_previo <= 2025) {
    echo "<option>$año_previo</option>";
    $año_previo++;
   }

    echo "</select>";


?>
    
</body>
</html>