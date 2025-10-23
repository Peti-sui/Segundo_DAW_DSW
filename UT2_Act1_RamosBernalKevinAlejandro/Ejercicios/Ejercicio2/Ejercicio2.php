<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        input[type="number"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100px;
        }

        button {
            padding: 8px 15px;
            margin-left: 10px;
            border-radius: 5px;
            border: none;
            background-color: #1a73e8;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #155ab6;
        }
    </style>
</head>
<!-- simple formulario que pregunta numero -->
<body>
<form method="post" action='./Ejercicio2.1.php'>
<label for="numero" id="texto_pedir">Introduzca un numero : </label>
<input type="number" name="numero" placeholder=" Ej: 6" required>
<button type="submit">Enviar numero</button>
</form>
</body>
</html>