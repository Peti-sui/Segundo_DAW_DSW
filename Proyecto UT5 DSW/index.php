<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: auth/login.php");
    exit;
}

require_once 'config/autoload.php';

$idioma = getIdiomaActual();
$tema = $_COOKIE['tema'] ?? 'claro';

$productos = Producto::getAll();
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <title><?php echo __('tienda_titulo'); ?></title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/tema-<?php echo $tema; ?>.css">
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="container">
        <h1><?php echo __('tienda_titulo'); ?></h1>
        
        <?php if ($_SESSION['rol'] === 'admin'): ?>
            <div class="admin-notice">
                <p><?php echo __('bienvenido_admin'); ?></p>
            </div>
        <?php endif; ?>
        
        <div class="nav-links">
            <a href="carrito/ver.php">🛒 <?php echo __('ver_carrito'); ?></a>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <a href="admin/index.php">⚙️ <?php echo __('panel_admin'); ?></a>
            <?php endif; ?>
            <a href="preferencias.php">🎨 <?php echo __('preferencias'); ?></a>
            <a href="auth/logout.php">🚪 <?php echo __('salir'); ?></a>
        </div>
        
        <div class="info-box mt-20">
            <h3><?php echo __('productos'); ?></h3>
            <p><strong><?php echo __('llaves'); ?>:</strong> <?php echo __('precio'); ?> normal × cantidad</p>
            <p><strong><?php echo __('bolso'); ?>:</strong> <?php echo __('precio'); ?> fijo (oferta especial)</p>
            <p><strong><?php echo __('mochila'); ?>:</strong> <?php echo __('precio'); ?> doble (producto premium)</p>
        </div>
        
        <div class="productos-container mt-20">
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <h3 class="d-flex justify-between align-center">
                        <?= htmlspecialchars($producto->getNombre()) ?>
                        <?php if ($producto->getTipo() == 'bolso'): ?>
                            <span class="badge badge-oferta"><?php echo __('oferta'); ?></span>
                        <?php elseif ($producto->getTipo() == 'mochila'): ?>
                            <span class="badge badge-premium">PREMIUM</span>
                        <?php endif; ?>
                    </h3>
                    
                    <p class="precio">
                        <strong><?= number_format($producto->getPrecio(), 2) ?> €</strong>
                        <?php if ($producto->getTipo() == 'mochila'): ?>
                            <br><small>(<?php echo __('precio_efectivo'); ?>: <?= number_format($producto->getPrecio() * 2, 2) ?> €)</small>
                        <?php endif; ?>
                    </p>
                    
                    <p><strong><?php echo __('tipo'); ?>:</strong> <?= __($producto->getTipo()) ?></p>
                    
                    <?php if ($producto->getImagen()): ?>
                        <img src="uploads/<?= htmlspecialchars($producto->getImagen()) ?>" alt="<?= htmlspecialchars($producto->getNombre()) ?>" class="img-fluid">
                    <?php endif; ?>
                    
                    <form action="carrito/agregar.php" method="post" class="mt-20">
                        <input type="hidden" name="id" value="<?= $producto->getId() ?>">
                        <button type="submit" class="w-100">🛒 <?php echo __('anadir_carrito'); ?></button>
                    </form>
                    
                    <?php if ($producto->getTipo() == 'bolso'): ?>
                        <div class="info-box mt-10">
                            <strong>✨ <?php echo __('oferta_especial'); ?>!</strong><br>
                            <?php echo __('precio_fijo_desc'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>