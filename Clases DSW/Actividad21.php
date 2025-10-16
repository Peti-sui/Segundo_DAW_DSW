<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <title>Mi página</title>
    <style>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Padres</title>
    /* estilos basicos para el documento */
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
        }

        form {
            background: #dbffe3ff;
            padding: 15px;
            max-width: 350px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        input[type="text"],
        input[type="number"] {
            width: 90%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            width: 95%;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #45a049;
        }

        .resultados {
            background: white;
            max-width: 350px;
            margin: 20px auto;
            padding: 10px;
            border-radius: 8px;
        }

        .error { color: red; }

    </style>
</head>

<?php
/* inicializa el arreglo para almacenar datos de los padres */
$padres = [];
/* variable para almacenar mensaje de error */
$error = '';
/* verifica si la solicitud es post indicando que el formulario fue enviado */
if ($_SERVER['REQUEST_METHOD'] == "POST"){
/* si existe el campo padres en el post se decodifica para mantener datos anteriores */
    if(!empty($_POST['padres'])){
        $padres = json_decode($_POST['padres'], true);
    }
    /* verifica que los campos requeridos no esten vacios */
    if(!empty($_POST['nombre']) && !empty($_POST['sexo_padres']) && !empty($_POST['hijos'])){
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $sexo_padres = isset($_POST['sexo_padres']) ? $_POST['sexo_padres'] : '';
        $hijos = isset($_POST['hijos']) ? $_POST['hijos'] : '';
/* valida que el sexo sea hombre o mujer ignorando mayusculas */
        if(strtolower($sexo_padres) == 'hombre' || strtolower($sexo_padres) == 'mujer'){
/* agrega los datos al arreglo de padres */
         $padres [] = [
        'nombre' => $nombre,
        'sexo_padres' => $sexo_padres,
        'hijos' => $hijos
        ];
        }else {
            /* si el sexo no es valido asigna mensaje de error */
            $error = "No se ha introducido un sexo valido, intentelo de nuevo";
        }
    }
}

    
?>


<body>
     <!-- formulario para ingresar datos del padre o madre -->
<form method="post">
 <label for="texto" class="texto_nombres_padres">Ingrese el nombre del padre o madre : </label>
<input type="text" name="nombre" placeholder="escriba el nombre...">
 <label for="texto" class="texto_sexo_padres">Ingrese el sexo del padre o la madre (hombre/mujer) : </label>
<input type="text" name="sexo_padres" placeholder="escriba el sexo...">
 <label for="texto" class="texto_num_hijos">Ingrese el numero de hijos : </label>
<input type="number" name="hijos" placeholder="escriba el numero de hijos...">
<!-- campo oculto para enviar el arreglo de padres acumulados -->
<input type="hidden" name="padres" value='<?php echo json_encode($padres);?>'>
 <input type="submit" value="Enviar">
</form>
</body>

<div class="resultados">
<?php
/* variables para construir el mensaje de salida */
$comiezo = '';
$parte_hijos = '';
/* recorre el arreglo de padres para mostrar la informacion */
foreach ($padres as $padre){
 /* determina el texto de inicio segun el sexo */
    if(strtolower($padre['sexo_padres']) == 'hombre'){
        $comienzo = "El señor";
    } elseif(strtolower($padre['sexo_padres']) == 'mujer'){
         $comienzo = "La señora";
    } else {
          /* si el sexo no es valido se salta la iteracion */
        continue;
    }
/* determina el texto sobre la cantidad de hijos */
    if($padre['hijos'] <= 0){
        $parte_hijos = "no tiene hijos";
    } elseif($padre['hijos'] == 1){
        $parte_hijos = "tiene 1 hijo";
    } else{
        $parte_hijos = "tiene {$padre['hijos']} hijos";
    }
 /* imprime el mensaje final para cada padre o madre */
    echo "$comienzo {$padre['nombre']}  $parte_hijos <br>";

}
/* imprime mensaje de error si existe */
        echo "$error";
        

?>
</div>


</html>