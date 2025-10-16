<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>document</title>

<style>
    /* reset de margenes y padding de todos los elementos */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* estilo del body, fuente, fondo y centrado de contenido */
    body {
        font-family: arial, helvetica, sans-serif;
        background: #f0f4f8;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* estilo del formulario, fondo blanco, sombra y bordes redondeados */
    form {
        background: #fff;
        padding: 20px 25px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 320px;
    }

    /* estilo de las etiquetas, bloque separado y color de texto */
    label {
        display: block;
        margin-top: 15px;
        font-size: 14px;
        color: #333;
    }

    /* estilo de los inputs tipo numero, ancho completo y borde redondeado */
    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    /* estilo del checkbox, mas grande y margen a la derecha */
    input[type="checkbox"] {
        margin-right: 5px;
        transform: scale(1.2);
    }

    /* estilo del boton submit, color de fondo, borde redondeado y transicion */
    input[type="submit"] {
        width: 100%;
        background: #4e73df;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 15px;
        font-weight: bold;
        margin-top: 20px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    /* efecto hover del boton */
    input[type="submit"]:hover {
        background: #3651b3;
    }

    /* estilo del resultado, fondo degradado, borde lateral y sombra */
    .resultado {
        margin-top: 25px;
        padding: 18px 20px;
        background: linear-gradient(135deg, #c9f1ff, #dceeff);
        color: #1e2a38;
        font-size: 1.2rem;
        font-weight: bold;
        text-align: center;
        border-radius: 12px;
        border: 1px solid #b3d9f5;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        letter-spacing: 0.5px;
    }
</style>

</head>

<?php
/* inicializacion de variables */
$precio_total = 0;
$num_emails = 0;

/* comprobacion si se envio el formulario */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* obtener el valor del input y validar que sea numerico */
    if (isset($_POST['num_emails']) && is_numeric($_POST['num_emails'])) {
        $num_emails = $_POST['num_emails'];

        /* asegurar que el numero no sea negativo */
        if ($num_emails < 0) {
            $num_emails = 0;
        }
    } else {
        $num_emails = 0; 
    }

    /* comprobar si el checkbox de seguro esta marcado */
    $seguro = isset($_POST['check_seguro']) ? true : false;
}
?>

<body>

<form method="post">
    <label for="texto" class="texto_emails">ingrese el numero de emails a enviar :</label>
    <input type="number" name="num_emails" placeholder="escriba el numero...">
    
    <label for="texto" class="texto_seguro">
        <input type="checkbox" name="check_seguro">
        quiere un seguro por mensaje?
    </label>
    
    <br>
    <input type="submit" value="enviar">
</form>

</body>

<?php
/* calculo del precio segun rango de emails y si tiene seguro */
if ((($num_emails >= 0) && ($num_emails <= 2000) && ($seguro == false))) {
    echo mostrarPrecio($precio_total);

} elseif (($num_emails >= 0) && ($num_emails <= 2000) && ($seguro == true)) {
    $precio_total = ($num_emails * 0.1);
    echo mostrarPrecio($precio_total);

} elseif (($num_emails >= 2001) && ($num_emails <= 10000) && ($seguro == false)) {
    $precio_total = ($num_emails * 0.7);
    echo mostrarPrecio($precio_total);

} elseif (($num_emails >= 2001) && ($num_emails <= 10000) && ($seguro == true)) {
    $precio_total = $num_emails * (0.7 + 0.1);
    echo mostrarPrecio($precio_total);

} elseif (($num_emails >= 10001) && ($seguro == false)) {
    $precio_total = ($num_emails * 0.2);
    echo mostrarPrecio($precio_total);

} elseif (($num_emails >= 10001) && ($seguro == true)) {
    $precio_total = $num_emails * (0.2 + 0.1);
    echo mostrarPrecio($precio_total);
}

/* funcion para mostrar el resultado en pantalla dentro de un div con clase resultado */
function mostrarPrecio($precio_total){
    echo "<div class=resultado>";
    echo "el precio total es : <br>";
    echo "$precio_total €";
    echo "</div>";
}
?>

</html>
