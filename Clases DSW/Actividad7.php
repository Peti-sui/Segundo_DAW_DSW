<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

/* creamos un array con los paises y su censo */
 $censo = [
    'España' => 47351567,
    'Italia' => 60461826,
    'Portugal' => 10276617,
    'Francia' => 65273511,
    'Grecia' => 10423054
 ];

 /* ordena el array de mayor a menor segun su censo */
 asort($censo, SORT_DESC);

 /* imprime el array */
    echo "<pre>";
 var_dump($censo);
    echo "</pre>";

?>
    
</body>
</html>