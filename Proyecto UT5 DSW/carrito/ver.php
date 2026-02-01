<?php
session_start();
require_once '../config/autoload.php';
require_once '../config/db.php';

$id = $_SESSION['id'];

$res = $conn->query(
    "SELECT c.id AS carrito_id, p.id AS producto_id, p.nombre, p.precio, p.tipo, p.imagen, c.cantidad
     FROM carrito c
     JOIN productos p ON c.producto_id = p.id
     WHERE c.usuario_id = $id"
);

$total = 0;
$items = [];

while ($r = $res->fetch_assoc()) {
    $items[] = $r;
}

$idioma = getIdiomaActual();
$tema = $_COOKIE['tema'] ?? 'claro';
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <title><?php echo __('carrito'); ?></title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/tema-<?php echo $tema; ?>.css">
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="container">
        <h1><?php echo __('carrito'); ?></h1>
        
        <div class="nav-links">
            <a href="../index.php">← <?php echo __('volver_tienda'); ?></a>
        </div>
        
        <?php if (empty($items)): ?>
            <div class="info-box text-center">
                <h3><?php echo __('carrito_vacio'); ?></h3>
                <a href="../index.php" class="mt-20">🛒 <?php echo __('seguir_comprando'); ?></a>
            </div>
        <?php else: ?>
            <div class="productos-container">
                <?php foreach ($items as $item): 
                    $producto = Producto::crearDesdeArray($item);
                    $precioCalculado = $producto->calcularPrecio($item['cantidad']);
                    $total += $precioCalculado;
                ?>
                <div class="producto">
                    <?php if ($item['imagen']): ?>
                        <img src="../uploads/<?= $item['imagen'] ?>" width="100" class="img-thumbnail">
                    <?php endif; ?>
                    
                    <h3><?= htmlspecialchars($item['nombre']) ?></h3>
                    <p><strong><?php echo __('tipo'); ?>:</strong> <?= __($item['tipo']) ?></p>
                    <p><strong><?php echo __('precio_unitario'); ?>:</strong> <?= number_format($item['precio'], 2) ?> €</p>
                    <p><strong><?php echo __('cantidad'); ?>:</strong> <?= $item['cantidad'] ?></p>
                    <p><strong><?php echo __('subtotal'); ?>:</strong> <span class="precio"><?= number_format($precioCalculado, 2) ?> €</span></p>
                    
                    <div class="carrito-acciones mt-20">
                        <form action="actualizar.php" method="post">
                            <input type="hidden" name="carrito_id" value="<?= $item['carrito_id'] ?>">
                            <button type="submit" name="accion" value="menos">−</button>
                            <span class="carrito-cantidad"><?= $item['cantidad'] ?></span>
                            <button type="submit" name="accion" value="mas">+</button>
                        </form>
                    </div>
                    
                    <?php if ($item['tipo'] == 'bolso'): ?>
                        <div class="info-box mt-10">
                            <strong>✨ <?php echo __('oferta_especial'); ?>!</strong><br>
                            <?php echo __('precio_fijo_desc'); ?>
                        </div>
                    <?php elseif ($item['tipo'] == 'mochila'): ?>
                        <div class="info-box mt-10">
                            <strong>⭐ <?php echo __('producto_premium'); ?></strong><br>
                            <?php echo __('precio_doble_desc'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="info-box mt-30">
                <h3><?php echo __('resumen_carrito'); ?></h3>
                <p class="precio"><b><?php echo __('total'); ?>: <?= number_format($total, 2) ?> €</b></p>
            </div>

            <div class="d-flex gap-10 mt-20">
                <form action="vaciar.php" method="post" class="w-100">
                    <button class="w-100">🗑️ <?php echo __('vaciar_carrito'); ?></button>
                </form>
                <form action="#" method="post" class="w-100">
                    <button class="w-100">💳 <?php echo __('proceder_pago'); ?></button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>