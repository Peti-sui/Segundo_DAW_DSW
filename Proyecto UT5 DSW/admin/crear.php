<?php
session_start();
require_once '../config/autoload.php';

if ($_SESSION['rol'] !== 'admin') die(__('error_acceso_denegado'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = floatval($_POST['precio']);
    $tipo = $_POST['tipo'];
    $imagen = '';

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $imagen = time() . '_' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], '../uploads/' . $imagen);
    }

    $datosProducto = [
        'nombre' => $nombre,
        'precio' => $precio,
        'tipo' => $tipo,
        'imagen' => $imagen
    ];
    
    $producto = Producto::crearDesdeArray($datosProducto);
    
    if ($producto->save()) {
        header("Location: index.php");
        exit;
    }
}

$idioma = getIdiomaActual();
$tema = $_COOKIE['tema'] ?? 'claro';
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <title><?php echo __('nuevo_producto'); ?></title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/tema-<?php echo $tema; ?>.css">
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="container">
        <div class="preferencias-container">
            <h2 class="text-center"><?php echo __('nuevo_producto'); ?></h2>
            
            <form method="post" enctype="multipart/form-data">
                <label for="nombre"><?php echo __('nombre'); ?>:</label>
                <input type="text" id="nombre" name="nombre" required>
                
                <label for="precio"><?php echo __('precio'); ?> (€):</label>
                <input type="number" id="precio" name="precio" step="0.01" required>
                
                <label for="tipo"><?php echo __('tipo'); ?>:</label>
                <select id="tipo" name="tipo">
                    <option value="llaves"><?php echo __('llaves'); ?></option>
                    <option value="bolso"><?php echo __('bolso'); ?></option>
                    <option value="mochila"><?php echo __('mochila'); ?></option>
                </select>
                
                <label for="imagen"><?php echo __('imagen'); ?>:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
                
                <div class="d-flex gap-10 mt-20">
                    <button type="submit" class="w-100">✅ <?php echo __('guardar'); ?></button>
                    <a href="index.php" class="w-100 text-center">❌ <?php echo __('cancelar'); ?></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>