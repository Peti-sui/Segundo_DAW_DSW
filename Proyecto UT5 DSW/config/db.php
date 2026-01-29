<?php
$conn = new mysqli("localhost", "root", "", "tienda_llaveros");

if ($conn->connect_error) {
    die("Error de conexión");
}
