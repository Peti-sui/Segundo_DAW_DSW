<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        input, label {
            display: block;
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            margin-top: 20px;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 5px 10px;
            text-align: left;
        }
        .dom_no_vali {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<?php
/** inicializacion del array de apartamentos */
$apartamentos = [];

/** comprobamos si se envio el formulario */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    /** recuperamos el array de apartamentos previo si existe */
    if (!empty($_POST['apartamentos'])) {
        $apartamentos = json_decode($_POST['apartamentos'], true);
    }

    /** recogemos y validamos el precio por noche */
    if (isset($_POST['precio_noche'])) {
        $precio_per_noche = $_POST['precio_noche'];

        /** aseguramos que el precio no sea negativo */
        if ($precio_per_noche < 0) {
            $precio_per_noche = 0;
        }
    } else {
        $precio_per_noche = 0; 
    }

    /** recogemos ciudad, wifi y dominio */
    $city = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
    $wifi = isset($_POST['wifi?']) ? 'Si' : 'No';
    $dominio = isset($_POST['dominio']) ? $_POST['dominio'] : '';

    /** solo agregamos el apartamento si el dominio es valido */
    if (!empty($dominio) && filter_var($dominio, FILTER_VALIDATE_URL)) {
        $apartamentos[] = [
            'precio/noche' => $precio_per_noche,
            'ciudad' => $city,
            'wifi' => $wifi,
            'pagina web' => $dominio
        ];
    } else {
        /** mostramos mensaje si el dominio es invalido y no se guarda */
        echo "<h2 class='dom_no_vali'>dominio invalido, no se guardo, intentelo de nuevo...</h2>";
    }
}
?>

<body>
    <form method="post">
        <label for="texto" class="texto">ingrese un precio/noche:</label>
        <input type="number" name="precio_noche" placeholder="escriba el precio...">
        
        <label for="texto" class="texto">ingrese una ciudad:</label>
        <input type="text" name="ciudad" placeholder="escriba la ciudad...">
        
        <label for="texto" class="texto">hay wifi?</label>
        <input type="checkbox" name="wifi?">
        
        <label for="texto" class="texto">introduzca su dominio:</label>
        <input type="text" name="dominio" placeholder="escriba el dominio...">

        <input type="hidden" name="apartamentos" value='<?php echo json_encode($apartamentos); ?>'>
        
        <input type="submit" value="enviar">
    </form>
</body>

<?php
/** mostramos la tabla de apartamentos solo si existe al menos un dominio */
if (!empty($dominio)) {

    echo "<h2>apartamentos disponibles :</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>precio/noche</th>
            <th>ciudad</th>
            <th>wifi?</th>
            <th>pagina web</th>
          </tr>";

    /** recorremos cada apartamento y mostramos sus datos */
    foreach ($apartamentos as $dato) {
        echo "<tr>";
        echo "<td>" . $dato['precio/noche'] . "</td>";
        echo "<td>" . $dato['ciudad'] . "</td>";
        echo "<td>" . $dato['wifi'] . "</td>";
        echo "<td>" . $dato['pagina web'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

</html>
