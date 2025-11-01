<?php
/* backend local para procesar documentos */

$errores = [];
$resultados = [];

/* rutas locales segun extension */
$destinos = [
    'txt' => './documentos/txt/',
    'pdf' => './documentos/pdf/',
    'docx' => './documentos/docx/',
    'xlsx' => './documentos/xlsx/',
    'pptx' => './documentos/pptx/',
    'odt' => './documentos/odt/',
];

/* procesamiento del formulario */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* obtencion de datos de texto */
    $autor = filter_input(INPUT_POST, 'autor', FILTER_SANITIZE_SPECIAL_CHARS);
    $nombre_documento = filter_input(INPUT_POST, 'nombre_documento', FILTER_SANITIZE_SPECIAL_CHARS);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_documento = filter_input(INPUT_POST, 'tipo_documento', FILTER_SANITIZE_SPECIAL_CHARS);
    $palabras_clave = filter_input(INPUT_POST, 'palabras_clave', FILTER_SANITIZE_SPECIAL_CHARS);
    $idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_SPECIAL_CHARS);
    $visibilidad = filter_input(INPUT_POST, 'visibilidad', FILTER_SANITIZE_SPECIAL_CHARS);

    $extensiones = $_POST['extension'] ?? [];
    $tematicas = $_POST['tematica'] ?? [];

    /* comprobacion de archivos */
    $claves = ['documento1', 'documento2', 'documento3'];
    $subidos = 0;
    foreach ($claves as $clave) {
        if (isset($_FILES[$clave]) && $_FILES[$clave]['error'] === UPLOAD_ERR_OK) {
            $subidos++;
        }
    }
    if ($subidos === 0) {
        $errores[] = "Debe al menos subir un documento para poder registrar";
    }

    /* proceso de archivos */
    foreach ($claves as $clave) {
        if (!isset($_FILES[$clave]) || $_FILES[$clave]['error'] !== UPLOAD_ERR_OK) {
            continue;
        }

        $nombre_original = $_FILES[$clave]['name'];
        $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));

        if (!array_key_exists($extension, $destinos)) {
            $errores[] = "Extension no permitida para el archivo: $nombre_original";
            continue;
        }

        $tipo_mime = mime_content_type($_FILES[$clave]['tmp_name']);
        if (strpos($tipo_mime, 'application/') !== 0 && strpos($tipo_mime, 'text/') !== 0) {
            $errores[] = "El archivo $nombre_original no tiene un tipo permitido";
            continue;
        }

        if (!is_dir($destinos[$extension])) {
            mkdir($destinos[$extension], 0777, true);
        }

        $nombre_seguro = preg_replace('/[^a-zA-Z0-9._-]/', '_', $nombre_original);
        $nombre_final = time() . '_' . uniqid() . '_' . $nombre_seguro;

        $ruta_final = $destinos[$extension] . $nombre_final;

        if (move_uploaded_file($_FILES[$clave]['tmp_name'], $ruta_final)) {
            $resultados[] = [
                'original' => $nombre_original,
                'ruta' => $ruta_final,
                'extension' => $extension,
                'mime' => $tipo_mime
            ];
        } else {
            $errores[] = "Error al mover el archivo: $nombre_original";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Resultado Documentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 30px;
            text-align: center;
        }

        .contenedor {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            padding: 20px 40px;
            max-width: 800px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background: #3897f0;
            color: white;
        }

        .errores {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <h2>Resultado del registro de documentos</h2>

        <?php if (!empty($errores)): ?>
            <div class="errores">
                <?php foreach ($errores as $e)
                    echo "<p>$e</p>"; ?>
            </div>
        <?php else: ?>
            <table>
                <tr>
                    <th>Campo</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td>Autor/es</td>
                    <td><?php echo $autor; ?></td>
                </tr>
                <tr>
                    <td>Nombre del documento</td>
                    <td><?php echo $nombre_documento; ?></td>
                </tr>
                <tr>
                    <td>Descripcion</td>
                    <td><?php echo $descripcion; ?></td>
                </tr>
                <tr>
                    <td>Tipo documento</td>
                    <td><?php echo $tipo_documento; ?></td>
                </tr>
                <tr>
                    <td>Extensiones</td>
                    <td><?php echo implode(', ', $extensiones); ?></td>
                </tr>
                <tr>
                    <td>Palabras clave</td>
                    <td><?php echo $palabras_clave; ?></td>
                </tr>
                <tr>
                    <td>Idioma</td>
                    <td><?php echo $idioma; ?></td>
                </tr>
                <tr>
                    <td>Visibilidad</td>
                    <td><?php echo $visibilidad; ?></td>
                </tr>
                <tr>
                    <td>Tematica</td>
                    <td><?php echo implode(', ', $tematicas); ?></td>
                </tr>
                <tr>
                    <th colspan="2">Archivos procesados</th>
                </tr>
                <?php foreach ($resultados as $r): ?>
                    <tr>
                        <td><?php echo $r['original']; ?></td>
                        <td><?php echo $r['ruta']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>