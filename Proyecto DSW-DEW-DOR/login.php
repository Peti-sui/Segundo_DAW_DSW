







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Iniciar sesion</h1>
    <h4>Si no tiene una cuenta creada se creara</h4>
    <form method="post" action="./bienvenida-login.php">
        <label for="usuario">Usuario: </label>
        <br>
        <input type="text" name="usuario" required>
        <br>
        <label for="contra">Contraseña: </label>
        <br>
        <input type="password" name="contra" required>
        <br>
        <button type="submit" name="login">Iniciar sesion</button>
    </form>
    
</body>
</html>