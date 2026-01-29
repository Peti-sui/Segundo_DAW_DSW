<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: auth/login.php");
    exit;
}

require_once 'config/db.php';

$productos = $conn->query("SELECT * FROM productos");
?>

<h1>Tienda de Llaveros</h1>

<?php if ($_SESSION['rol'] === 'admin'): ?>
    <p>Bienvenido administrador</p>
<?php endif; ?>

<?php while ($p = $productos->fetch_assoc()): ?>
    <div>
        <h3><?= $p['nombre'] ?></h3>
        <p><?= $p['precio'] ?> €</p>

        <form action="carrito/agregar.php" method="post">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button>Añadir</button>
        </form>
    </div>
<?php endwhile; ?>

<a href="carrito/ver.php">Ver carrito</a>
<?php if ($_SESSION['rol'] === 'admin'): ?>
    <a href="admin/index.php">Panel de administración</a>
<?php endif; ?>
<a href="preferencias.php">Preferencias</a>
<a href="auth/logout.php">Salir</a>

