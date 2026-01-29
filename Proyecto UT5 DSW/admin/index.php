<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado");
}


session_start();
require_once '../config/db.php';

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado");
}

$productos = $conn->query("SELECT * FROM productos");
?>

<h1>Panel de Administración</h1>

<a href="crear.php">➕ Nuevo producto</a>
<br><br>

<table border="1">
<tr>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Tipo</th>
    <th>Acciones</th>
</tr>

<?php while ($p = $productos->fetch_assoc()): ?>
<tr>
    <td><?= $p['nombre'] ?></td>
    <td><?= $p['precio'] ?> €</td>
    <td><?= $p['tipo'] ?></td>
    <td>
        <a href="editar.php?id=<?= $p['id'] ?>">✏️ Editar</a>
        <a href="eliminar.php?id=<?= $p['id'] ?>"
           onclick="return confirm('¿Eliminar producto?')">🗑 Eliminar</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="../index.php">Volver a la tienda</a>
