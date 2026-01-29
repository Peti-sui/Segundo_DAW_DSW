<?php
session_start();
require_once '../config/db.php';

$id = $_SESSION['id'];

$res = $conn->query(
    "SELECT p.nombre, p.precio, c.cantidad
     FROM carrito c
     JOIN productos p ON c.producto_id = p.id
     WHERE c.usuario_id = $id"
);

$total = 0;
while ($r = $res->fetch_assoc()) {
    echo $r['nombre']." x".$r['cantidad']."<br>";
    $total += $r['precio'] * $r['cantidad'];
}

echo "<b>Total: $total €</b>";
