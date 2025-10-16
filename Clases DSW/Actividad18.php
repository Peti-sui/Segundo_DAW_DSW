<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <?php
    /* Se crea el arreglo vacío para almacenar las películas ingresadas */
    $pelis=[];

    /* Comprueba si el formulario fue enviado por POST */
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        /* Si existe una lista previa se decodifica y se asigna al arreglo */
        if(!empty($_POST['lista'])){
            $pelis=json_decode($_POST['lista']);
        }
        /* Si se recibe un nuevo nombre se agrega al arreglo */
        if(!empty($_POST['nombre'])){
        $peli=isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $pelis[]=$peli;
        }
    } 
    ?>

<form method="post">
 <label for="texto" class="texto">Ingrese una pelicula:</label>
<input type="text" name="nombre" placeholder="escriba la pelicula...">
<!-- Campo oculto para enviar la lista actual codificada en JSON -->
<input type="hidden" name="lista" value='<?php echo json_encode($pelis);?>'>
 <input type="submit" value="Enviar">
</form>

<?php
/* Si el arreglo no está vacío se genera la tabla con las películas */
if(!empty($pelis)){
    echo "<table>";
    echo "<tr><th>Nombre</th></tr>";

    foreach($pelis as $p){
        echo"<tr><td>$p</td></tr>";
    }
    echo "</table>";
}
?>
    
</body>
</html>
