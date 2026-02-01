<?php
session_start();
require_once '../config/autoload.php';
require_once '../config/db.php';

$idUsuario = $_SESSION['id'];
$idProducto = $_POST['id'];

$producto = Producto::findById($idProducto);
if (!$producto) {
    header("Location: ../index.php");
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO carrito (usuario_id, producto_id, cantidad)
     VALUES (?, ?, 1)
     ON DUPLICATE KEY UPDATE cantidad = cantidad + 1"
);
$stmt->bind_param("ii", $idUsuario, $idProducto);
$stmt->execute();

header("Location: ver.php");
exit;
?>