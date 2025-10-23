<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 30px;
            margin: 0;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        #resultado2 {
            color: #1a73e8;
            font-size: 2rem;
            margin-top: 10px;
        }

        a {
            text-decoration: none;
            color: #1a73e8;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        snap{
             color: #1a73e8;
        }
        
    </style>
</head>
<body>
    <?php
$numero = 0;
$total = 0;
/* recuperacion de datos introducidos en input */
if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(!empty($_POST['numero'])){
        $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
    }
}
?>

<!-- ------------------------------------------------------------------ -->

<?php

/* comprueba si es positivo */
if($numero > 0){
/* a partir del dos suma hasta el numero introducido en dos en dos */
for($i = 2; $i < $numero; $i+= 2) {
    $total += $i;
 }
 /* muestra de resultados */
echo "<h1 id='resultado'>El total de <snap>$numero</snap> es : </h1>";
echo "<h1 id='resultado2'>$total</h1>";
}
?>
</body>
</html>