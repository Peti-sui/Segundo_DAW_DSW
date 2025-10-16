<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

/* Crear un array llamado Agenda que contenga 2 citas con su hora */
    $Agenda = array ("Dentista a las 12", "Reunion a las 3");

/* Imprimir el array con var_dump */
    var_dump ($Agenda) ;

    echo "<br>";

/* Modifica la primera cita del array */
    $Agenda[0] = "Dentista a las 4";

    var_dump ($Agenda) ;

    echo "<br>";

/* Elimina la primera cita del array */
    unset($Agenda[0]);

        var_dump ($Agenda) ;

    echo "<br>";

/* Agrega 3 nuevas citas al array */
    $Agenda[] = "Comida a las 2";
    $Agenda[] = "Cita con el jefe a las 5";
    $Agenda[] = "Cena a las 8";

/* Imprime el array con un foreach */
    echo "<ul>";

    foreach ($Agenda as $cita) {
        echo "<li>$cita</li>";
    }
    
    echo "</ul>";
    
    ?>
    
</body>
</html>