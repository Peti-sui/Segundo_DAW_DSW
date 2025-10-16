<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /*  se crea una variable para el nombre de una chica y otra para el nombre de un chico*/
        $NombreChica = "Danna";
        $NombreChico = "Kevin";

        /*  se crea una variable para la fecha actual y otra para el año de nacimiento del chico*/
        $FechaActual = date("Y");
        $Nacimiento = $FechaActual - 2004;

        /*  se imprimen las variables en pantalla*/
            echo "A $NombreChica le gusta $NombreChico <br>";

             echo "Me llamo $NombreChico y mi edad es de $Nacimiento años <br>";

     ?>
    
</body>
</html>