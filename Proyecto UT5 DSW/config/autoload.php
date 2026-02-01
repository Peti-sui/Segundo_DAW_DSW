<?php
// Autoload de clases
spl_autoload_register(function($className) {
    $file = __DIR__ . '/../clases/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once 'db.php';
require_once 'i18n.php';
?>