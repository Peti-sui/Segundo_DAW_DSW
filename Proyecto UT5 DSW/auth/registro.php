<?php
session_start();
require_once '../config/db.php';

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario  = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    // 1️⃣ Validaciones básicas
    if ($usuario === '' || $password === '') {
        $errores[] = "Todos los campos son obligatorios";
    }

    // 2️⃣ PROHIBIR registrar admin
    if ($usuario === 'admin') {
        $errores[] = "Ese nombre de usuario no está permitido";
    }

    if (empty($errores)) {

        // 3️⃣ Comprobar si el usuario ya existe
        $stmt = $conn->prepare(
            "SELECT id FROM usuarios WHERE usuario = ?"
        );
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errores[] = "El usuario ya existe";
        } else {

            // 4️⃣ Crear usuario NORMAL (rol fijo)
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $rol  = 'user';

            $stmt = $conn->prepare(
                "INSERT INTO usuarios (usuario, password, rol)
                 VALUES (?, ?, ?)"
            );
            $stmt->bind_param("sss", $usuario, $hash, $rol);
            $stmt->execute();

            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>

<h2>Registro</h2>

<?php foreach ($errores as $e): ?>
    <p style="color:red"><?= $e ?></p>
<?php endforeach; ?>

<form method="post">
    <input type="text" name="usuario" placeholder="Usuario">
    <input type="password" name="password" placeholder="Contraseña">
    <button>Registrarse</button>
</form>

<a href="login.php">Volver al login</a>

</body>
</html>
