<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

/* crea una variable llamada FraseConcurso y asignale una frase de tu eleccion */
 $FraseConsurso = "La sonrisa sera la mejor arma contra la tristeza hola";

 /* Convierte la frase en un array, separando las palabras por los espacios y las comas */
 $ArrayParaComparar = preg_split("/[\s,]+/", $FraseConsurso);

 /* Cuenta el numero de palabras que tiene la frase */
 /* Si la frase tiene 10 palabras o menos, imprime "La frase esta permitida: [frase]" */
 /* Si la frase tiene mas de 10 palabras, imprime "La frase tiene mas de 10 palabras, por lo tanto no esta permitida, intente de nuevo" */
    if (count($ArrayParaComparar) <= 10) {
        echo "La frase esta permitida : $FraseConsurso";
    } else {
        echo "La frase tiene mas de 10 palabras, por lo tanto no esta permitida, intente de nuevo";
    }
?>
    
</body>
</html>