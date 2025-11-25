
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Subir documentos - formulario</title>
</head>
<body>

  <form action="upload.php" method="post" enctype="multipart/form-data" >
    <label for="autor">Autor</label>
    <input  name="autor" type="text" >

    <label for="title">Nombre del documento</label>
    <input  name="title" type="text"  >

    <label for="file1">Documento 1 (obligatorio si no subes el 2)</label>
    <input name="file1" type="file" required>

    <label for="file2">Documento 2 (opcional)</label>
    <input  name="file2" type="file" >

    <button type="submit" name="submit">Enviar</button>
  </form>

</body>
</html>
