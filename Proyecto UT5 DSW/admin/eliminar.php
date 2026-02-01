<?php
session_start();
require_once '../config/autoload.php';

if ($_SESSION['rol'] !== 'admin') die(__('error_acceso_denegado'));

$id = $_GET['id'];
$producto = Producto::findById($id);

if ($producto) {
    if ($producto->getImagen() && file_exists('../uploads/' . $producto->getImagen())) {
        unlink('../uploads/' . $producto->getImagen());
    }
    
    $producto->delete();
}

header("Location: index.php");
exit;
?>