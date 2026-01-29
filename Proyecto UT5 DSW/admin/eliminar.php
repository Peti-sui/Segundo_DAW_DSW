<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado");
}


session_start();
require_once '../config/db.php';

if ($_SESSION['rol'] !== 'admin') die("Acceso denegado");

$id = $_GET['id'];

$conn->query("DELETE FROM productos WHERE id=$id");

header("Location: index.php");
