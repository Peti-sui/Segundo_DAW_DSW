<?php
session_start();
require_once '../config/autoload.php';

if ($_SESSION['rol'] !== 'admin') die(__('error_acceso_denegado'));

$id = $_GET['id'];
$producto = Producto::findById($id);

if (!$producto) die(__('error_producto_no_encontrado'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto->setNombre($_POST['nombre']);
    $producto->setPrecio(floatval($_POST['precio']));
    $producto->setTipo($_POST['tipo']);

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $imagen = time() . '_' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], '../uploads/' . $imagen);
        $producto->setImagen($imagen);
    }

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
    <title><?php echo __('editar_producto'); ?></title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/tema-<?php echo $tema; ?>.css">
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="container">
        <div class="preferencias-container">
            <h2 class="text-center"><?php echo __('editar_producto'); ?></h2>
            
            <form method="post" enctype="multipart/form-data">
                <label for="nombre"><?php echo __('nombre'); ?>:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $producto->getNombre() ?>" required>
                
                <label for="precio"><?php echo __('precio'); ?> (€):</label>
                <input type="number" id="precio" name="precio" step="0.01" value="<?= $producto->getPrecio() ?>" required>
                
                <label for="tipo"><?php echo __('tipo'); ?>:</label>
                <select id="tipo" name="tipo">
                    <option value="llaves" <?= $producto->getTipo()=='llaves'?'selected':'' ?>><?php echo __('llaves'); ?></option>
                    <option value="bolso" <?= $producto->getTipo()=='bolso'?'selected':'' ?>><?php echo __('bolso'); ?></option>
                    <option value="mochila" <?= $producto->getTipo()=='mochila'?'selected':'' ?>><?php echo __('mochila'); ?></option>
                </select>
                
                <?php if ($producto->getImagen()): ?>
                    <div class="mt-20">
                        <label><?php echo __('imagen_actual'); ?>:</label>
                        <img src="../uploads/<?= $producto->getImagen() ?>" width="150" class="img-thumbnail">
                    </div>
                <?php endif; ?>
                
                <label for="imagen"><?php echo __('nueva_imagen'); ?>:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
                
                <div class="d-flex gap-10 mt-20">
                    <button type="submit" class="w-100">✅ <?php echo __('actualizar'); ?></button>
                    <a href="index.php" class="w-100 text-center">❌ <?php echo __('cancelar'); ?></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>