<?php
session_start();
session_destroy();
header('Location: ./Actividad3_UT3.php');
die();
?>