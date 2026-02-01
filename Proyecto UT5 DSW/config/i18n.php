<?php
// Cargador de idiomas
function cargarIdioma($idioma = 'es') {
    $archivoIdioma = __DIR__ . '/../idiomas/' . $idioma . '.php';
    
    if (file_exists($archivoIdioma)) {
        return require $archivoIdioma;
    }
    
    return require __DIR__ . '/../idiomas/es.php';
}

// Función para traducir
function __($key, $idioma = null) {
    static $translations = null;
    
    if ($translations === null) {
        $idiomaCookie = $_COOKIE['idioma'] ?? 'es';
        $translations = cargarIdioma($idiomaCookie);
    }
    
    return $translations[$key] ?? $key;
}

// Función para obtener el idioma actual
function getIdiomaActual() {
    return $_COOKIE['idioma'] ?? 'es';
}

// Función para cambiar idioma
function cambiarIdioma($nuevoIdioma) {
    setcookie("idioma", $nuevoIdioma, time() + 2592000, "/");
}
?>