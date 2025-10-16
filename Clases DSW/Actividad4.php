<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

/* declarar un array con 5 nombres de amigos*/
        $Amiguis = array("Danna", "Kevin", "Pedro", "Diego", "Luis");

        /* imprimir el primer nombre del array */
        echo "$Amiguis[0] se va de viaje <br>";

        /* imprimir el segundo nombre del array y la ciudad a la que va de viaje */
        $Ciudades = array("Tijuana", "Monterrey", "Puebla");

        echo "$Amiguis[1] se va de viaje a $Ciudades[0] <br>";

/* imprimir nombre del array y la ciudad a la que va de viaje mediante un shuffle aleatoriamente */
        shuffle($Amiguis);
        shuffle($Ciudades);

        echo "$Amiguis[0] se va de viaje con $Amiguis[0] a la bonita ciudad de $Ciudades[0] <br>";
        
?>
    
</body>
</html>