<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    setcookie("idioma", $_POST['idioma'], time()+3600);
    setcookie("tema", $_POST['tema'], time()+3600);
}
?>

<form method="post">
    <select name="idioma">
        <option value="es">Español</option>
        <option value="en">Inglés</option>
    </select>

    <select name="tema">
        <option value="claro">Claro</option>
        <option value="oscuro">Oscuro</option>
    </select>

    <button>Guardar</button>
</form>
