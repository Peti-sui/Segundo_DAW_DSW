<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

        <?php

        /*  se crea una variable para el precio de unos pies, otra para el IVA y otra para el IGIC*/
            $PrecioDeMisPies = 175;
            $IVA = 0.21;
            $IGIC = 0.07;

            /*  se calcula el precio final con IVA y con IGIC*/
            $PrecioFinalIVA = $PrecioDeMisPies + ($PrecioDeMisPies * $IVA);
            $PrecioFinalIGIC = $PrecioDeMisPies + ($PrecioDeMisPies * $IGIC);

            /*  se imprimen las variables en pantalla*/
                echo "El precio de mis pies es: $PrecioDeMisPies euros (no fui creativo) <br>";
                echo "El precio de mis pies con IVA es: " . $PrecioFinalIVA . " euros <br>";
                echo "El precio de mis pies con IGIC es: " . $PrecioFinalIGIC . " euros <br>";

        ?>
    
</body>
</html>