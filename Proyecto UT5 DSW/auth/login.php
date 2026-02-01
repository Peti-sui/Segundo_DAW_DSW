<?php
session_start();
require_once '../config/autoload.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';
    
    $stmt = $conn->prepare("SELECT id, password, rol FROM usuarios WHERE usuario=?");
    $stmt->bind_param("s", $_POST['usuario']);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $u = $res->fetch_assoc();
        if (password_verify($_POST['password'], $u['password'])) {
            $_SESSION['id'] = $u['id'];
            $_SESSION['rol'] = $u['rol'];
            header("Location: ../index.php");
            exit;
        } else {
            $error = __("error_contrasena_incorrecta");
        }
    } else {
        $error = __("error_usuario_no_registrado");
    }
}

$idioma = getIdiomaActual();
$tema = $_COOKIE['tema'] ?? 'claro';
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/tema-<?php echo $tema; ?>.css">
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="container">
        <div class="preferencias-container">
            <h2 class="text-center">Login</h2>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="post">
                <label for="usuario"><?php echo __('usuario'); ?>:</label>
                <input type="text" id="usuario" name="usuario" required>
                
                <label for="password"><?php echo __('password'); ?>:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit" class="w-100 mt-20">🔑 <?php echo __('entrar'); ?></button>
            </form>
            
            <div class="text-center mt-20">
                <a href="registro.php">📝 <?php echo __('crear_cuenta'); ?></a>
            </div>
        </div>
    </div>
</body>
</html>