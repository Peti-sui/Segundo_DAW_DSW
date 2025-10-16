<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /* Se inicializa el arreglo que contendrá los alumnos y sus notas */
    $alumnos = [];

    /* Verifica si el formulario fue enviado mediante POST */
    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        /* Si hay una lista previa enviada en el campo oculto se decodifica a un array asociativo */
        if(!empty($_POST['lista'])){
            $alumnos = json_decode($_POST['lista'], true);
        }

        /* Si se ingresan nombre y nota válidos, se añaden al arreglo como clave y valor */
        if(!empty($_POST['nombre']) && (!empty($_POST['nota']))){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $nota = isset($_POST['nota']) ? $_POST['nota'] : '';
            $alumnos[$nombre] = $nota;
        }
    }
    ?>

    <!-- Formulario para ingresar un nuevo alumno con su nota -->
    <form method="post">
        <label for="texto" class="texto">Ingrese un alumno:</label>
        <input type="text" name="nombre" placeholder="escriba el nombre...">

        <label for="texto" class="texto">Ingrese su nota:</label>
        <input type="number" name="nota" placeholder="escriba la nota...">

        <!-- Campo oculto que transporta la lista de alumnos ya cargados -->
        <input type="hidden" name="lista" value='<?php echo json_encode($alumnos);?>'>

        <input type="submit" value="Enviar">
    </form>

    <?php
    /* Si el arreglo de alumnos no está vacío se construye la tabla con los datos */
    if (!empty($alumnos)) {
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Nota</th></tr>";

        foreach ($alumnos as $p => $nota) {
            echo "<tr><td>$p</td><td>$nota</td></tr>";
        }

        echo "</table>";
    }
    ?>
</body>
</html>
