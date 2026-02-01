<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    die(__('error_acceso_denegado'));
}

require_once '../config/autoload.php';

$idioma = getIdiomaActual();
$tema = $_COOKIE['tema'] ?? 'claro';

$productos = Producto::getAll();
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <title><?php echo __('panel_titulo'); ?></title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/tema-<?php echo $tema; ?>.css">
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="container">
        <h1><?php echo __('panel_titulo'); ?></h1>
        
        <div class="nav-links">
            <a href="crear.php">➕ <?php echo __('nuevo_producto'); ?></a>
            <a href="../index.php">← <?php echo __('volver_tienda'); ?></a>
        </div>

        <?php if (empty($productos)): ?>
            <div class="info-box text-center">
                <p><?php echo __('no_productos'); ?></p>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th><?php echo __('nombre'); ?></th>
                        <th><?php echo __('precio'); ?></th>
                        <th><?php echo __('tipo'); ?></th>
                        <th><?php echo __('imagen'); ?></th>
                        <th><?php echo __('acciones'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto->getNombre()) ?></td>
                        <td><?= number_format($producto->getPrecio(), 2) ?> €</td>
                        <td><?= __($producto->getTipo()) ?></td>
                        <td>
                            <?php if ($producto->getImagen()): ?>
                                <img src="../uploads/<?= htmlspecialchars($producto->getImagen()) ?>" width="50" class="img-thumbnail">
                            <?php else: ?>
                                <span class="text-muted"><?php echo __('sin_imagen'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="d-flex gap-10">
                            <a href="editar.php?id=<?= $producto->getId() ?>" class="text-center">✏️ <?php echo __('editar'); ?></a>
                            <a href="eliminar.php?id=<?= $producto->getId() ?>" onclick="return confirm('<?php echo __('error_eliminar_producto'); ?>')" class="text-center">🗑 <?php echo __('eliminar'); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>