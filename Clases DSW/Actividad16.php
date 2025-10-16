<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- se realiza un formulario que pida una adivinanza y al enviarlo debe decir si la respuesta es correcta o incorrecta -->
<div class="Adivinanza">Esta cosa se devora a todas las cosas; <br>
Pájaros, bestias, árboles, flores;<br>
Carcome el hierro, muerde el acero;
Muele duras piedras y las reduce a harina;<br>
Mata al rey, arruina la ciudad,<br>
Y derriba a la montaña.</div> <br>

<!-- se realiza el formulario -->
<form method="post">
    <label for="respuesta">Ingrese su respuesta y adivine:</label>
    <input name="respuesta" type="text" placeholder="Ingrese su respuesta">
    <input type="submit" value="Enviar">
</form>

<?php
/* se realiza el php que procese el formulario */

if((!empty($_POST['respuesta']))) {
    $respuesta = $_POST['respuesta'] ? trim($_POST['respuesta']) : '';
/* realizamos la condicion para saber si la respuesta es correcta o incorrecta */
    if ($respuesta == "Tiempo" || $respuesta == "tiempo") {
        echo "<br> Respuesta correcta! Felicidades!";
        /* si la respuesta es correcta se muestra el mensaje pero si no es correcta se muestra otro mensaje */
    } elseif($respuesta != "Tiempo" || $respuesta != "tiempo") {
        echo "<br> Respuesta incorrecta! Eres un primo como no vas a saberlo! La respuesta es... jajsjda no te lo voy a decir!";
    }

/* si no se ingresa nada en el formulario se muestra otro mensaje */
}else {
    echo "<br> Por favor ingrese una respuesta!";
}
?>

    
</body>
</html>