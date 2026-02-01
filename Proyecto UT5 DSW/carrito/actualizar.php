<?php
session_start();
require_once '../config/db.php';

$id = $_POST['carrito_id'];
$accion = $_POST['accion'];

$res = $conn->query("SELECT cantidad FROM carrito WHERE id=$id");
$r = $res->fetch_assoc();
$cantidad = $r['cantidad'];

if ($accion === 'mas') {
    $cantidad++;
} elseif ($accion === 'menos') {
    $cantidad--;
}

if ($cantidad > 0) {
    $stmt = $conn->prepare("UPDATE carrito SET cantidad=? WHERE id=?");
    $stmt->bind_param("ii", $cantidad, $id);
    $stmt->execute();
} else {
    $conn->query("DELETE FROM carrito WHERE id=$id");
}

header("Location: ver.php");
exit;
?>