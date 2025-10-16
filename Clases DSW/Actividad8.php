
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>lista de peliculas</title>
    <style>
        /* estilo general de body */
        body {
            font-family: arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }

        /* estilo de los parrafos */
        p {
            font-size: 1.1rem;
            margin: 5px 0;
        }

        /* estilo de la tabla */
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        /* estilo de celdas */
        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }

        /* estilo de encabezado de la tabla */
        th {
            background: #6c63ff;
            color: white;
        }
    </style>
</head>
<body>

<h2>peliculas en parrafos</h2>

<?php

/* array con las 6 peliculas favoritas */
$peliculas = [
    "Your Name",
    "Interstellar",
    "inception",
    "titanic",
    "matrix",
    "el padrino"
];

/* recorrer el array e imprimir cada pelicula en parrafo con su posicion */
foreach ($peliculas as $index => $pelicula) {
    echo "<p>pelicula " . ($index + 1) . ": $pelicula</p>";
}
?>

<h2>peliculas en tabla con color aleatorio</h2>

<table>
    <tr>
        <th>posicion</th>
        <th>titulo</th>
    </tr>
    <?php
    /* recorrer array y generar fila por pelicula */
    foreach ($peliculas as $index => $pelicula) {
        /* generar color aleatorio para el titulo */
        $r = rand(0,255);
        $g = rand(0,255);
        $b = rand(0,255);
        $color = "rgb($r,$g,$b)";

        /* imprimir fila con posicion y titulo coloreado */
        echo "<tr>";
        echo "<td>" . ($index + 1) . "</td>";
        echo "<td style='color: $color;'>$pelicula</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
