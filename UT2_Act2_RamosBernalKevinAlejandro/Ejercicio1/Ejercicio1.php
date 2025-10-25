<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #e3f2fd);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 40px;
        }

        form {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 350px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: #444;
            display: block;
            margin-top: 12px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="file"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        img {
            border-radius: 8px;
            box-shadow: 0 0 6px rgba(0,0,0,0.1);
            margin-top: 8px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            width: 350px;
            margin: 20px auto;
            padding: 20px;
        }

        li {
            padding: 6px 0;
            border-bottom: 1px solid #eee;
            color: #333;
        }

        li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <form method="post" action="./insertar_usuario.php" enctype="multipart/form-data">
        <h1>Incio</h1>
        <label for="nombre">Nombre: </label>
        <br>
        <input type="text" name="nombre" placeholder="Ej: Pedro" required>
        <br>
        <label for="apellido1">Primer Apellido: </label>
        <br>
        <input type="text" name="apellido1" placeholder="Ej: Sanchez" required>
        <br>
        <label for="apellido2">Segundo Apellido: </label>
        <br>
        <input type="text" name="apellido2" placeholder="Ej: Del chipre" required>
        <br>
        <label for="user">Tipo de Usuario: </label>
        <select>
            <option>Admin</option>
            <option>Empleado</option>
            <option>Cliente</option>
        </select>
        <br>
        <label for="tel">Telefono: </label>
        <br>
        <input type="tel" name="tel" placeholder="Ej: 688473656" required>
        <br>
        <label for="correo">Correo: </label>
        <br>
        <input type="email" name="correo" placeholder="Ej: info@gmail.com" required>
        <br>
        <label for="tel">Foto de Usuario: </label>
        <br>
        <input type="file" name="foto" required>
        <br>
        <label for="contra1">Contraseña: </label>
        <br>
        <input type="text" name="contra1" placeholder=".........." required>
        <br>
        <label for="contra2">Repetir Contraseña: </label>
        <br>
        <input type="text" name="contra2" placeholder=".........." required>
        <br>
        <button type="submit">Registrar</button>

    </form>

</body>
</html>