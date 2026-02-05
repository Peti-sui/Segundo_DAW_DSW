<?php
/* Inicio de sesion y comprobacion de usuario autenticado */
/* Se inicia la sesion y se redirige a index publico si no hay id en sesion */
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index_public.php");
    exit;
}

/* Carga de dependencias y conexion a la base de datos */
/* No se modifica la logica solo se importan los ficheros necesarios */
require_once 'config/autoload.php';
require_once 'config/db.php';

/* Obtencion de idioma y tema del usuario */
/* Idioma actual usado para etiquetas */
/* Tema obtenido desde cookie con valor por defecto claro */
$idioma = getIdiomaActual();
$tema = $_COOKIE['tema'] ?? 'claro';

/* Obtener todos los productos usando el modelo Producto */
$productos = Producto::getAll();

/* Id del usuario actual obtenido de la sesion */
$idUsuario = $_SESSION['id'];

/* Obtener ids de productos que ya estan en el carrito del usuario */
/* Se usa una consulta directa a la base de datos y se almacenan los ids en un array */
$carritoIds = [];
$carritoRes = $conn->query(
    "SELECT producto_id FROM carrito WHERE usuario_id = $idUsuario"
);
while ($row = $carritoRes->fetch_assoc()) {
    $carritoIds[] = $row['producto_id'];
}

/* Obtener ids de productos que ya estan en la lista de deseos del usuario */
/* Se usa una consulta directa a la base de datos y se almacenan los ids en un array */
$deseosIds = [];
$deseosRes = $conn->query(
    "SELECT producto_id FROM lista_deseos WHERE usuario_id = $idUsuario"
);
while ($row = $deseosRes->fetch_assoc()) {
    $deseosIds[] = $row['producto_id'];
}

/* Contar pedidos pendientes del usuario */
/* Se realiza una consulta con COUNT para obtener el total de pedidos en estado pendiente */
$pedidosPendientes = 0;
$pendientesRes = $conn->query(
    "SELECT COUNT(*) as total FROM pedidos 
     WHERE usuario_id = $idUsuario AND estado = 'pendiente'"
);
if ($pendientesRes) {
    $pendientesData = $pendientesRes->fetch_assoc();
    $pedidosPendientes = $pendientesData['total'];
}

/* Contar elementos en lista de deseos usando el array previamente obtenido */
$totalDeseos = count($deseosIds);
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
                <p>𝜗𝜚 <?php echo __('bienvenido_admin'); ?>,
                    <strong><?= htmlspecialchars($_SESSION['usuario'] ?? 'Admin') ?></strong></p>
            </div>
        <?php else: ?>
            <div class="info-box">
                <p>𝜗𝜚 <?php echo __('bienvenido_usuario'); ?>,
                    <strong><?= htmlspecialchars($_SESSION['usuario'] ?? 'Usuario') ?></strong></p>
            </div>
        <?php endif; ?>

        <div class="nav-links">
            <a href="carrito/ver.php">𝜗𝜚 <?php echo __('ver_carrito'); ?></a>
            <a href="deseos/ver.php">
                𝜗𝜚 <?php echo __('lista_deseos'); ?>
                <?php if ($totalDeseos > 0): ?>
                    <span class="badge badge-wish"><?= $totalDeseos ?></span>
                <?php endif; ?>
            </a>
            <a href="carrito/mis_pedidos.php">
                𝜗𝜚 <?php echo __('mis_pedidos'); ?>
                <?php if ($pedidosPendientes > 0): ?>
                    <span class="badge badge-warning"><?= $pedidosPendientes ?></span>
                <?php endif; ?>
            </a>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <a href="admin/index.php">𝜗𝜚 <?php echo __('panel_admin'); ?></a>
                <a href="admin/pedidos.php">𝜗𝜚 <?php echo __('gestion_pedidos'); ?></a>
            <?php endif; ?>
            <a href="preferencias.php">𝜗𝜚 <?php echo __('preferencias'); ?></a>
            <a href="auth/logout.php">𝜗𝜚 <?php echo __('salir'); ?></a>
        </div>

        <div class="info-box mt-20">
            <h3><?php echo __('productos'); ?></h3>
            <p><strong><?php echo __('llaves'); ?>:</strong> <?php echo __('precio'); ?> normal × cantidad</p>
            <p><strong><?php echo __('bolso'); ?>:</strong> <?php echo __('precio'); ?> fijo (oferta especial)</p>
            <p><strong><?php echo __('mochila'); ?>:</strong> <?php echo __('precio'); ?> doble (producto premium)</p>
        </div>

        <div class="productos-container mt-20">
            <?php
            /* Iterar sobre la coleccion de productos y preparar variables de estado por producto */
            /* No se modifica la estructura solo se evalua si el producto ya esta en carrito o en deseos */
            foreach ($productos as $producto):
                $yaEnCarrito = in_array($producto->getId(), $carritoIds);
                $yaEnDeseos = in_array($producto->getId(), $deseosIds);
                ?>
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
                            <br><small>(<?php echo __('precio_efectivo'); ?>:
                                <?= number_format($producto->getPrecio() * 2, 2) ?> €)</small>
                        <?php endif; ?>
                    </p>

                    <p><strong><?php echo __('tipo'); ?>:</strong> <?= __($producto->getTipo()) ?></p>

                    <?php if ($producto->getImagen()): ?>
                        <img src="uploads/<?= htmlspecialchars($producto->getImagen()) ?>"
                            alt="<?= htmlspecialchars($producto->getNombre()) ?>" class="img-fluid">
                    <?php endif; ?>

                    <div class="d-flex gap-10 mt-20">
                        <!-- Boton Anadir al Carrito -->
                        <form action="carrito/agregar.php" method="post" class="w-50">
                            <input type="hidden" name="id" value="<?= $producto->getId() ?>">
                            <?php if ($yaEnCarrito): ?>
                                <a href="carrito/ver.php" class="w-100 text-center ya-en-carrito">
                                    𝜗𝜚 <?php echo __('ya_en_carrito'); ?>
                                </a>
                            <?php else: ?>
                                <button type="submit" class="w-100">𝜗𝜚 <?php echo __('anadir_carrito'); ?></button>
                            <?php endif; ?>
                        </form>

                        <!-- Boton Anadir a Lista de Deseos -->
                        <form action="deseos/agregar.php" method="post" class="w-50">
                            <input type="hidden" name="id" value="<?= $producto->getId() ?>">
                            <?php if ($yaEnDeseos): ?>
                                <a href="deseos/ver.php" class="w-100 text-center ya-en-deseos">
                                    𝜗𝜚 <?php echo __('ya_en_deseos'); ?>
                                </a>
                            <?php else: ?>
                                <button type="submit" class="w-100">𝜗𝜚 <?php echo __('anadir_deseos'); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>

                    <?php if ($producto->getTipo() == 'bolso'): ?>
                        <div class="info-box mt-10">
                            <strong>𝜗𝜚 <?php echo __('oferta_especial'); ?>!</strong><br>
                            <?php echo __('precio_fijo_desc'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>