<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    /* variables base para el almacenamiento y uso de datos del formulario */
    $tickets = [];
    $nombre = '';
    $altura = 0;
    $edad = 0;
    $check = '';

    /* verifica si el formulario fue enviado mediante metodo post */
    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        /* recupera tickets anteriores usando el campo oculto del formulario */
        if(!empty($_POST['tickets'])){
            $tickets = json_decode($_POST['tickets'], true);
        }

        /* valida que todos los campos requeridos esten presentes y no vacios */
        if(!empty($_POST['nombre']) && !empty($_POST['altura']) && !empty($_POST['edad']) && !empty($_POST['check'])){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $altura = isset($_POST['altura']) ? $_POST['altura'] : '';
            $edad   = isset($_POST['edad'])   ? $_POST['edad']   : '';
            $check  = isset($_POST['check'])  ? 'ok' : 'no';

            /* calcula el id unico de manera incremental según los tickets ya almacenados */
            if (!empty($tickets)) {
                $ids_existentes = array_column($tickets, 'id');
                $id_unico = max($ids_existentes) + 1;
            } else {
                $id_unico = 1;
            }

            /* agrega el nuevo ticket al array de tickets */
            $tickets[] = [
                'id'     => $id_unico,
                'nombre' => $nombre,
                'altura' => $altura,
                'edad'   => $edad,
                'check'  => $check
            ];
        }

    }
?>

   <form method="post">
        <label for="texto" class="texto">Ingrese un nombre:</label>
        <input type="text" name="nombre" placeholder="escriba el nombre...">
        
        <label for="texto" class="texto">Ingrese una altura (cm):</label>
        <input type="number" name="altura" placeholder="escriba la altura...">
        
        <label for="texto" class="texto">Ingrese su edad:</label>
        <input type="number" name="edad" placeholder="escriba la edad...">
        
        <label for="texto" class="texto">
            ¿Rechaza llevarnos a juicio por daños y perjuicios de un mal mantenimiento?
        </label>
        <input type="checkbox" name="check">
        
        <!-- guarda los tickets anteriores en formato json para mantener el acumulado -->
        <input type="hidden" name="tickets" value='<?php echo json_encode($tickets);?>'>
        
        <input type="submit" value="Enviar">
    </form>
    

<?php
    /* muestra la tabla solo si los datos actuales cumplen los requisitos de validacion */
    if(($altura > 120) && ($edad > 16) && ($check == 'ok') ){
        echo "<h2>Tabla de Tickets</h2>";
        echo "<table border='1'>";
        echo "<tr>
                <th>Numero de Referencia</th>
                <th>Nombre</th>
                <th>Altura</th>
                <th>Edad</th>
                <th>Check</th>
              </tr>";

        /* recorre y muestra cada ticket almacenado */
        foreach ($tickets as $ticket) {
            echo "<tr>";
            echo "<td>" . $ticket['id'] . "</td>";
            echo "<td>" . $ticket['nombre'] . "</td>";
            echo "<td>" . $ticket['altura'] . "</td>";
            echo "<td>" . $ticket['edad'] . "</td>";
            echo "<td>" . $ticket['check'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        /* mensaje mostrado si no cumple los requisitos */
        echo "No puedes tener tu ticket, mis condolencias...";
    }
?>

</body>
</html>