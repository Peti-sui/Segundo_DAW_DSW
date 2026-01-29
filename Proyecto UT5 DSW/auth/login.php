<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn->prepare(
        "SELECT id, password, rol FROM usuarios WHERE usuario=?"
    );
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
        }
    }
}
?>

<form method="post">
    <input name="usuario">
    <input type="password" name="password">
    <button>Entrar</button>
</form>

<a href="registro.php">Crear cuenta</a>
<?php
