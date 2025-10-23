<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
    <style>

    form {
            display: flex;
            flex-direction: column;
            align-items: center; 
            margin-bottom: 20px;
        }

         table {
            border-collapse: collapse;
            border-color: blue;
            margin-left: 47%;
        }


    </style>
</head>

<?php

$filas = '';
$columnas = '';
$columnas_mostrar = [] ;
$filas_mostrar = [] ;
/* recuperacion de datos introducidos en input */
if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(!empty($_POST['columnas']) && !empty($_POST['filas'])){

                 $columnas = $_POST['columnas'];
                 $filas = $_POST['filas'];

    }



}

?>

<body>
<!-- formulario para tratado de datos -->
<form method="post">

<label for="columnas">Escriba el numero de columnas</label>
<br>
<input type="number" name="columnas">
<br>
<label for="filas">Escriba el numero de filas</label>
<br>
<input type="number" name="filas">
<br>
<button type="submit">Enviar</button>




</form>
    
</body>

<?php
/* sencilla tabla con la muestra de la misma usando dos iteraciones y mostrando numero mediante auxiliar */
echo "<table border ='1'>";

$aux = 1;

        for ($i = 1; $i <= $filas; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $columnas; $j++) {
            echo "<td>$aux</td>";
            $aux++;
            }
            echo "</tr>";
        }
        echo "</table>";


?>

</html>