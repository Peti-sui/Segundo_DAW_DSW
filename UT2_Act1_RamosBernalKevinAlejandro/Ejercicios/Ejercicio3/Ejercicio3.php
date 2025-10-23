<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio3</title>

    <style>
        /* estilo general de la pagina */
        body {
            font-family: Arial, sans-serif;
            background-color: #e9eff3;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 40px;
        }

        /* estilo del formulario principal */
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
            width: 400px;
            transition: transform 0.2s ease-in-out;
        }

        /* efecto al pasar el raton sobre el formulario */
        form:hover {
            transform: translateY(-5px);
        }

        /* estilo del titulo */
        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        /* estilo de las etiquetas */
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555555;
        }

        /* estilo de los campos de entrada */
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        /* efecto al enfocar un campo */
        input:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }

        /* estilo de los checkbox y radio */
        input[type="checkbox"],
        input[type="radio"] {
            margin-top: 10px;
            margin-right: 5px;
        }

        /* estilo del boton */
        button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* efecto hover en el boton */
        button:hover {
            background-color: #0056b3;
        }

        /* estilo adicional simple para mejorar la legibilidad */
        br {
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <!-- formulario de inscripcion -->
    <form method="post" action="./ResultadoEj3.php">
        
        <h2 id="titulo">formulario de inscripcion</h2>

        <!-- campos de nombre y apellidos -->
        <label for="nombre">nombre y apellidos</label>
        <input type="text" name="nombre" placeholder="nombre" required>
        <input type="text" name="apellido1" placeholder="primer apellido" required>
        <input type="text" name="apellido2" placeholder="segundo apellido" required>
        <br>

        <!-- fecha de nacimiento -->
        <label for="fecha_nacimiento">fecha de nacimiento</label>
        <select name="mes" required>
            <option>seleccione el mes</option>
            <option>enero</option>
            <option>febrero</option>
            <option>marzo</option>
            <option>abril</option>
            <option>mayo</option>
            <option>junio</option>
            <option>julio</option>
            <option>agosto</option>
            <option>septiembre</option>
            <option>octubre</option>
            <option>noviembre</option>
            <option>diciembre</option>
        </select>

        <?php
            /* generacion dinamica de los dias del mes */
            echo "<select name='dia' required>";
            echo "<option>seleccione el dia</option>";
            foreach(range(1,31) as $pas) {
                echo "<option>$pas</option>";
            }
            echo "</select>";
        ?>

        <input type="number" name="anio" min="1940" max="2009" placeholder="año..." required>
        <br>

        <!-- direccion y datos personales -->
        <label for="direccion">direccion</label>
        <input type="text" name="direccion" placeholder="ej: calle..." required>
        <br>

        <input type="text" name="documentoIdentidad" placeholder="documento de identidad" required>
        <input type="text" name="ciudad" placeholder="ciudad ej: las palmas de gran canaria" required>
        <br>

        <!-- pais -->
        <label for="pais">pais</label>
        <input type="text" name="pais" placeholder="ej: españa" required>
        <br>

        <!-- correo -->
        <label for="email">correo electronico</label>
        <input type="email" name="email" placeholder="ej: info@gmail.com" required>
        <br>

        <!-- telefono -->
        <label for="nuero">numero telefono</label>
        <input type="tel" name="numero" placeholder="ej: 638492678" required>
        <br>

        <!-- recibir informacion -->
        <label for="recibir">deseo recibir informacion:</label>
        <input type="checkbox" name="recibir">
        <br>

        <!-- genero -->
        <label for="sexo">sexo</label>
        <br>
        <input type="radio" name="sexo" value="masculino" required> masculino
        <input type="radio" name="sexo" value="femenino" required> femenino
        <br>

        <!-- boton de envio -->
        <button type="submit" id="enviar">enviar</button>

    </form>

</body>
</html>
