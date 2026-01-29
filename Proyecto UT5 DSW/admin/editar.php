<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado");
}



session_start();
require_once '../config/db.php';

if ($_SESSION['rol'] !== 'admin') die("Acceso denegado");

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn->prepare(
        "UPDATE productos SET nombre=?, precio=?, tipo=? WHERE id=?"
    );
    $stmt->bind_param(
        "sdsi",
        $_POST['nombre'],
        $_POST['precio'],
        $_POST['tipo'],
        $id
    );
    $stmt->execute();

    header("Location: index.php");
    exit;
}

$res = $conn->query("SELECT * FROM productos WHERE id=$id");
$p = $res->fetch_assoc();
?>

<h2>Editar producto</h2>

<form method="post">
    <input name="nombre" value="<?= $p['nombre'] ?>">
    <input name="precio" type="number" step="0.01" value="<?= $p['precio'] ?>">

    <select name="tipo">
        <option value="llaves" <?= $p['tipo']=='llaves'?'selected':'' ?>>Llaves</option>
        <option value="bolso" <?= $p['tipo']=='bolso'?'selected':'' ?>>Bolso</option>
        <option value="mochila" <?= $p['tipo']=='mochila'?'selected':'' ?>>Mochila</option>
    </select>

    <button>Actualizar</button>
</form>
