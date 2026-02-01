<?php
session_start();
require_once 'config/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idioma = $_POST['idioma'] ?? 'es';
    $tema = $_POST['tema'] ?? 'claro';
    
    cambiarIdioma($idioma);
    setcookie("tema", $tema, time() + 2592000, "/");
    
    header("Location: preferencias.php");
    exit;
}

$idioma_actual = getIdiomaActual();
$tema_actual = $_COOKIE['tema'] ?? 'claro';
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma_actual; ?>">
<head>
    <title><?php echo __('preferencias_titulo'); ?></title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/tema-<?php echo $tema_actual; ?>.css">
</head>
<body class="tema-<?php echo $tema_actual; ?>">
    <div class="container">
        <div class="preferencias-container">
            <h2 class="text-center"><?php echo __('preferencias_titulo'); ?></h2>
            
            <div class="info-box">
                <p><strong><?php echo __('configuracion_actual'); ?>:</strong></p>
                <p><?php echo __('idioma'); ?>: <?php echo $idioma_actual == 'es' ? __('espanol') : __('ingles'); ?></p>
                <p><?php echo __('tema'); ?>: <?php echo $tema_actual == 'claro' ? __('claro') : __('oscuro'); ?></p>
            </div>
            
            <form method="post">
                <label for="idioma"><?php echo __('idioma'); ?>:</label>
                <select name="idioma" id="idioma">
                    <option value="es" <?php echo $idioma_actual == 'es' ? 'selected' : ''; ?>><?php echo __('espanol'); ?></option>
                    <option value="en" <?php echo $idioma_actual == 'en' ? 'selected' : ''; ?>><?php echo __('ingles'); ?></option>
                </select>
                
                <label for="tema"><?php echo __('tema'); ?>:</label>
                <select name="tema" id="tema">
                    <option value="claro" <?php echo $tema_actual == 'claro' ? 'selected' : ''; ?>><?php echo __('claro'); ?></option>
                    <option value="oscuro" <?php echo $tema_actual == 'oscuro' ? 'selected' : ''; ?>><?php echo __('oscuro'); ?></option>
                </select>
                
                <button type="submit" class="w-100 mt-20">💾 <?php echo __('guardar_preferencias'); ?></button>
            </form>
            
            <div class="text-center mt-20">
                <a href="index.php">← <?php echo __('volver_tienda'); ?></a>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('tema').addEventListener('change', function() {
            const temaActual = this.value;
            const linkTema = document.querySelector('link[href*="tema-"]');
            
            if (linkTema) {
                linkTema.href = 'css/tema-' + temaActual + '.css';
            }
            
            document.body.className = 'tema-' + temaActual;
        });
        
        document.getElementById('idioma').addEventListener('change', function() {
            document.documentElement.lang = this.value;
        });
    </script>
</body>
</html>