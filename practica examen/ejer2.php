<?php

$errores = [];
$autor_sano = "";
$nombre_doc_sano = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ==== RECUPERACIÓN DE DATOS ====
    $autor = isset($_POST['autor']) ? $_POST['autor'] : '';
    $nombre_doc = isset($_POST['nombre_doc']) ? $_POST['nombre_doc'] : '';

    // SANITIZACIÓN
    $autor_sano = filter_var($autor, FILTER_SANITIZE_STRING);
    $nombre_doc_sano = filter_var($nombre_doc, FILTER_SANITIZE_STRING);

    // VALIDACIONES
    if ($autor_sano == '') {
        $errores[] = "El autor no puede estar vacío <br>";
    }

    if ($nombre_doc_sano == '') {
        $errores[] = "El nombre del documento no puede estar vacío <br>";
    }

    // ==== VALIDAR ARCHIVOS ====

    $fichero1_subido = (isset($_FILES['doc1']) && $_FILES['doc1']['error'] == 0);
    $fichero2_subido = (isset($_FILES['doc2']) && $_FILES['doc2']['error'] == 0);

    if (!$fichero1_subido && !$fichero2_subido) {
        $errores[] = "Debe subir al menos un documento para poder registrar <br>";
    }

    // Si no hay errores → guardar imágenes y redirigir
    if (empty($errores)) {

        $directorio = "./uploads/";

        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $rutas_imagenes = [];

        // PROCESAR DOC 1
        if ($fichero1_subido) {

            $nombre_imagen1 = $directorio . basename($_FILES['doc1']['name']);
            $tipo_real1 = mime_content_type($_FILES['doc1']['tmp_name']);

            if (strpos($tipo_real1, "image/") === 0) {
                move_uploaded_file($_FILES['doc1']['tmp_name'], $nombre_imagen1);
                $rutas_imagenes[] = $nombre_imagen1;
            }
        }

        // PROCESAR DOC 2
        if ($fichero2_subido) {

            $nombre_imagen2 = $directorio . basename($_FILES['doc2']['name']);
            $tipo_real2 = mime_content_type($_FILES['doc2']['tmp_name']);

            if (strpos($tipo_real2, "image/") === 0) {
                move_uploaded_file($_FILES['doc2']['tmp_name'], $nombre_imagen2);
                $rutas_imagenes[] = $nombre_imagen2;
            }
        }

        // ENVIAR A OTRA PÁGINA
        session_start();
        $_SESSION['autor'] = $autor_sano;
        $_SESSION['nombre_doc'] = $nombre_doc_sano;
        $_SESSION['imagenes'] = $rutas_imagenes;

        header("Location: resultado.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gestión de imágenes</title>
</head>

<body>

    <h2>Subir documentos</h2>

    <?php
    foreach ($errores as $error) {
        echo $error;
    }
    ?>

    <form method="post" enctype="multipart/form-data">

        <input type="text" name="autor" placeholder="Autor">
        <br><br>

        <input type="text" name="nombre_doc" placeholder="Nombre del documento">
        <br><br>

        Documento 1:
        <input type="file" name="doc1">
        <br><br>

        Documento 2:
        <input type="file" name="doc2">
        <br><br>

        <button type="submit">Enviar</button>
    </form>

</body>
</html>
