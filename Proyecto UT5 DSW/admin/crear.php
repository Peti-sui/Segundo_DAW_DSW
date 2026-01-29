<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado");
}

session_start();
require_once '../config/db.php';

if ($_SESSION['rol'] !== 'admin') die("Acceso denegado");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn->prepare(
        "INSERT INTO productos (nombre, precio, tipo) VALUES (?, ?, ?)"
    );
    $stmt->bind_param(
        "sds",
        $_POST['nombre'],
        $_POST['precio'],
        $_POST['tipo']
    );
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<h2>Nuevo producto</h2>

<form method="post">
    <input name="nombre" placeholder="Nombre" required>
    <input name="precio" type="number" step="0.01" required>

    <select name="tipo">
        <option value="llaves">Llaves</option>
        <option value="bolso">Bolso</option>
        <option value="mochila">Mochila</option>
    </select>

    <button>Guardar</button>
</form>
