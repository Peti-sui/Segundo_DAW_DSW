<?php
session_start();
require_once '../config/autoload.php';

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';

    $usuario  = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($usuario === '' || $password === '') {
        $errores[] = __("error_todos_campos");
    }

    if ($usuario === 'admin') {
        $errores[] = __("error_usuario_no_permitido");
    }

    if (empty($errores)) {
        $stmt = $conn->prepare(
            "SELECT id FROM usuarios WHERE usuario = ?"
        );
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errores[] = __("error_usuario_existe");
        } else {
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

$idioma = getIdiomaActual();
$tema = $_COOKIE['tema'] ?? 'claro';
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <title><?php echo __('registro_titulo'); ?></title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/tema-<?php echo $tema; ?>.css">
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="container">
        <div class="preferencias-container">
            <h2 class="text-center"><?php echo __('registro_titulo'); ?></h2>

            <?php if (!empty($errores)): ?>
                <div class="error-message">
                    <?php foreach ($errores as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <label for="usuario"><?php echo __('usuario'); ?>:</label>
                <input type="text" id="usuario" name="usuario" required>
                
                <label for="password"><?php echo __('password'); ?>:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit" class="w-100 mt-20">📝 <?php echo __('registrarse'); ?></button>
            </form>

            <div class="text-center mt-20">
                <a href="login.php">← <?php echo __('volver_login'); ?></a>
            </div>
        </div>
    </div>
</body>
</html>