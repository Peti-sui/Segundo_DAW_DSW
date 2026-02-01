<?php
session_start();
require_once '../config/db.php';

$id = $_SESSION['id'];
$conn->query("DELETE FROM carrito WHERE usuario_id = $id");

header("Location: ver.php");
exit;
?>