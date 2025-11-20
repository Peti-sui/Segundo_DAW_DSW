<?php
/* iniciar mensaje */
$mensaje = "";

/* productos disponibles */
$productos = [
    "manzana" => 1,
    "platano" => 2,
    "naranja" => 1.5
];

/* crear o actualizar carrito */
if (isset($_POST["añadir"])) {
    $producto = $_POST["producto"];
    $cantidad = $_POST["cantidad"] ?? 1;

    /* leer carrito existente */
    $carrito = $_COOKIE["carrito"] ?? [];

    if (!is_array($carrito))
        $carrito = [];

    /* si existe producto sumar cantidad */
    if (isset($carrito[$producto])) {
        $carrito[$producto] += $cantidad;
    } else {
        $carrito[$producto] = $cantidad;
    }

    /* guardar cookie 1 dia */
    setcookie("carrito[" . $producto . "]", $carrito[$producto], time() + 86400);
    $mensaje = "Producto añadido correctamente";
}

/* eliminar producto */
if (isset($_POST["eliminar"])) {
    $producto = $_POST["producto"];
    setcookie("carrito[" . $producto . "]", "", time() - 60);
    $mensaje = "Producto eliminado";
}

/* limpiar carrito */
if (isset($_POST["limpiar"])) {
    if (isset($_COOKIE["carrito"])) {
        foreach ($_COOKIE["carrito"] as $clave => $valor) {
            setcookie("carrito[$clave]", "", time() - 60);
        }
    }
    $mensaje = "Carrito limpio";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4</title>
</head>

<body>
    <?php if ($mensaje != "")
        echo "<p><b>$mensaje</b></p>"; ?>
    <form method="post">
        <label>Producto
            <select name="producto">
                <?php foreach ($productos as $nombre => $precio)
                    echo "<option value='$nombre'>$nombre (€$precio)</option>"; ?>
            </select>
        </label>
        <label>Cantidad
            <input type="number" name="cantidad" value="1" min="1">
        </label>
        <button type="submit" name="añadir">Añadir al carrito</button>
    </form>

    <h2>Carrito actual</h2>
    <?php
    if (isset($_COOKIE["carrito"]) && count($_COOKIE["carrito"]) > 0) {
        echo "<table border='1'><tr><th>Producto</th><th>Cantidad</th><th>Precio unitario</th><th>Total</th><th>Accion</th></tr>";
        $total = 0;
        foreach ($_COOKIE["carrito"] as $prod => $cant) {
            $precio = $productos[$prod];
            $subtotal = $precio * $cant;
            $total += $subtotal;
            echo "<tr>
                    <td>$prod</td>
                    <td>$cant</td>
                    <td>€$precio</td>
                    <td>€$subtotal</td>
                    <td>
                        <form method='post' style='display:inline'>
                            <input type='hidden' name='producto' value='$prod'>
                            <button type='submit' name='eliminar'>Eliminar</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "<tr><td colspan='3'><b>Total</b></td><td colspan='2'><b>€$total</b></td></tr>";
        echo "</table>";
        echo "<form method='post'><button type='submit' name='limpiar'>Limpiar carrito</button></form>";
    } else {
        echo "<p>Carrito vacio</p>";
    }
    ?>
</body>

</html>