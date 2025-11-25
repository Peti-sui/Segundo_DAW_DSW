
<?php
$errores = [];
$fotos_directorios = [];
$autor = "";
$title = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $autor = $_POST['autor'] ?? '';
    $title = $_POST['title'] ?? '';

    $autor_sano = filter_var($autor, FILTER_SANITIZE_STRING);

    if ($autor_sano == '') {
        $errores[] = 'El autor no puede estar vacio <br>';
    }
    $title_sano = filter_var($title, FILTER_SANITIZE_STRING);

    if ($title_sano == '') {
        $errores[] = 'El titulo no puede estar vacio <br>';
    }

    if(isset($_FILES['file1'])){
        if($_FILES['file1']['error']==0 
        && isset($_FILES['file2']) && $_FILES['file2']['error']==0){

            $directorio_subida = './achivos_cargar/';

            if (!is_dir($directorio_subida)) {
                mkdir($directorio_subida, 0777, true);
               }

            $imagen1 = $directorio_subida . basename($_FILES['file1']['name']);
            $imagen2 = $directorio_subida . basename($_FILES['file2']['name']);

            $tipo_real = mime_content_type($_FILES['file1']['tmp_name']);
            $tipo_real2 = mime_content_type($_FILES['file2']['tmp_name']);

            
            if (strpos($tipo_real, 'image/') === 0)
                { move_uploaded_file($_FILES['file1']['tmp_name'], $imagen1);
                    $fotos_directorios[] = $imagen1;
                } else {
                    $errores[] = 'El archivo 1 no es una imagen valida <br>';
                }

                if (strpos($tipo_real2, 'image/') === 0)
                { move_uploaded_file($_FILES['file2']['tmp_name'], $imagen2);
                    $fotos_directorios[] = $imagen2;
                } else {
                    $errores[] = 'El archivo 2 no es una imagen valida <br>';
                }
            }
        } else {
            $errores[] = 'Debes subir al menos un archivo <br>';
        }
    }            

?>




<?php

echo "<table border='1'>
<tr>
<th>Nombre documento</th>
<th>Imagen</th>
</tr>";

foreach($fotos_directorios as $foto){
    echo "<tr>
    <td>$title_sano</td>
    <td><img src='$foto' width='100'></td>
    </tr>";
}

echo "</table>";

?>