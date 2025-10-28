<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin-top: 30px;
            color: #333;
            text-align: center;
            font-size: 24px;
        }

        form {
            background: #fff;
            padding: 25px 35px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 500px;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
            color: #444;
        }

        input[type="text"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input[type="checkbox"],
        input[type="radio"] {
            margin-right: 6px;
        }

        button {
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
        }

        button:hover {
            background: #0056b3;
        }

        small {
            color: #777;
            font-size: 12px;
        }

        br {
            line-height: 1.8;
        }

        /* separacion visual para secciones */
        .bloque {
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px dashed #ddd;
        }
    </style>
</head>
<body>
    <h1>Registro de Documentos</h1>

    <form method="post" action="procesar_documentos.php" enctype="multipart/form-data">

        <label>autor/es:</label>
        <br>
        <input type="text" name="autor" placeholder="ej: juan perez">
        <br>


        <label>nombre del documento:</label>
        <br>
        <input type="text" name="nombre_documento" placeholder="ej: informe trimestral">
        <br>


        <label>descripcion:</label>
        <br>
        <textarea name="descripcion" rows="4" cols="40" placeholder="breve descripcion"></textarea>
        <br>

        <label>tipo documento:</label>
        <br>
        <select name="tipo_documento">
            <option value="Documento">Documento</option>
            <option value="Informe">Informe</option>
            <option value="Presentacion">Presentacion</option>
            <option value="Variados">Variados</option>
        </select>
        <br>


        <label>extension de archivo (elige las que apliquen):</label><br>
        <label><input type="checkbox" name="extension[]" value="txt"> txt</label>
        <label><input type="checkbox" name="extension[]" value="pdf"> pdf</label>
        <label><input type="checkbox" name="extension[]" value="docx"> docx</label>
        <label><input type="checkbox" name="extension[]" value="xlsx"> xlsx</label>
        <label><input type="checkbox" name="extension[]" value="pptx"> pptx</label>
        <label><input type="checkbox" name="extension[]" value="odt"> odt</label>
        <br>

        <label>palabras clave:</label
        ><br>
        <input type="text" name="palabras_clave" placeholder="palabra1, palabra2">
        <br>

   
        <label>idioma:</label>
        <br>
        <select name="idioma">
            <option value="Español">Español</option>
            <option value="Inglés">Inglés</option>
            <option value="Otros">Otros</option>
        </select>
        <br>


        <label>visibilidad:</label>
        <br>
        <label><input type="radio" name="visibilidad" value="Publico" checked> Publico</label>
        <label><input type="radio" name="visibilidad" value="Privado"> Privado</label>
        <br>

 
        <label>tematica:</label>
        <br>
        <label><input type="checkbox" name="tematica[]" value="Administracion"> Administracion</label>
        <label><input type="checkbox" name="tematica[]" value="Finanzas"> Finanzas</label>
        <label><input type="checkbox" name="tematica[]" value="Negocio"> Negocio</label>
        <label><input type="checkbox" name="tematica[]" value="Informatica"> Informatica</label>
        <label><input type="checkbox" name="tematica[]" value="Otros"> Otros</label>
        <br>

        <label>subir documentos (maximo 3):</label>
        <br>
        <input type="file" name="documento1">
        <br>
        <input type="file" name="documento2">
        <br>
        <input type="file" name="documento3">
        <br>
        <small>al menos 1 documento es obligatorio</small>
        <br>

        <button type="submit">Registrar Documentos</button>
    </form>
</body>
</html>
