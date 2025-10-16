<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php

/* declaramos variables */
 $añoNacimiento = 2008;
$diaNacimiento = 29;
$mesNacimiento = 9;

 /* calcula la edad */
 $edad = DATE('Y') - $añoNacimiento;

 /* mediante una estructura condicional if else if else mostramos los mensajes correspondientes */

    if ($edad >= 18 && $edad < 65 || $diaNacimiento >= DATE('d') && $mesNacimiento >= DATE('m')) {
        echo "Eres mayor de edad, puedes pasar";
    } elseif ($edad < 18) {
        echo "Eres menor de edad, salpica!";
    }elseif ($edad >= 65) {
        echo "Eres un pureta vete a jugar a la petanca porfi";
    }

         echo "<br>";
         /* muestra el año actual */
         echo "Fecha de hoy : " . DATE('Y');

       



?>
    
</body>
</html>