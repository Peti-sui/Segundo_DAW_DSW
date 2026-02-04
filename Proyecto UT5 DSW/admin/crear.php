<?php
session_start();
require_once '../config/autoload.php';

if ($_SESSION['rol'] !== 'admin') die(__('error_acceso_denegado'));

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $precio = floatval($_POST['precio']);
    $tipo = $_POST['tipo'];
    $imagen = '';

    // Validar nombre no vacío
    if (empty($nombre)) {
        $error = __("error_nombre_vacio");
    }
    // Validar precio positivo
    elseif ($precio <= 0) {
        $error = __("error_precio_invalido");
    }
    // Validar que no exista producto con mismo nombre y tipo
    elseif (Producto::nombreTipoExiste($nombre, $tipo)) {
        $error = __("error_nombre_tipo_duplicado");
    } else {
        // Procesar imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            $imagen = time() . '_' . $_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], '../uploads/' . $imagen);
        }

        $datosProducto = [
            'nombre' => $nombre,
            'precio' => $precio,
            'tipo' => $tipo,
            'imagen' => $imagen
        ];
        
        try {
            $producto = Producto::crearDesdeArray($datosProducto);
            
            if ($producto->save()) {
                $success = __("exito_producto_creado");
                // Limpiar formulario después de éxito
                $_POST = array();
            } else {
                $error = __("error_guardar_producto");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}

$idioma = getIdiomaActual();
$tema = $_COOKIE['tema'] ?? 'claro';
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <title><?php echo __('nuevo_producto'); ?></title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/tema-<?php echo $tema; ?>.css">
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-help {
            font-size: 0.9em;
            color: #666;
            margin-top: 5px;
        }
        
        body.tema-oscuro .form-help {
            color: #aaa;
        }
    </style>
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="container">
        <div class="preferencias-container">
            <h2 class="text-center"><?php echo __('nuevo_producto'); ?></h2>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <strong>❌ <?php echo __('error'); ?>:</strong> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="success-message">
                    <strong>✅ <?php echo __('exito'); ?>:</strong> <?php echo $success; ?>
                    <div class="mt-10">
                        <a href="index.php"><?php echo __('ver_productos'); ?></a> | 
                        <a href="crear.php"><?php echo __('crear_otro'); ?></a>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (!$success): ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre"><?php echo __('nombre'); ?> *</label>
                    <input type="text" id="nombre" name="nombre" 
                           value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>" 
                           required
                           placeholder="<?php echo __('ejemplo_nombre'); ?>">
                    <div class="form-help">
                        <?php echo __('regla_nombre_tipo'); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="precio"><?php echo __('precio'); ?> (€) *</label>
                    <input type="number" id="precio" name="precio" step="0.01" 
                           value="<?php echo htmlspecialchars($_POST['precio'] ?? ''); ?>" 
                           required min="0.01"
                           placeholder="0.00">
                </div>
                
                <div class="form-group">
                    <label for="tipo"><?php echo __('tipo'); ?> *</label>
                    <select id="tipo" name="tipo" required>
                        <option value=""><?php echo __('seleccionar_tipo'); ?></option>
                        <option value="llaves" <?php echo ($_POST['tipo'] ?? '') == 'llaves' ? 'selected' : ''; ?>>
                            <?php echo __('llaves'); ?>
                        </option>
                        <option value="bolso" <?php echo ($_POST['tipo'] ?? '') == 'bolso' ? 'selected' : ''; ?>>
                            <?php echo __('bolso'); ?>
                        </option>
                        <option value="mochila" <?php echo ($_POST['tipo'] ?? '') == 'mochila' ? 'selected' : ''; ?>>
                            <?php echo __('mochila'); ?>
                        </option>
                    </select>
                    <div class="form-help">
                        <?php echo __('regla_tipo_unico'); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="imagen"><?php echo __('imagen'); ?></label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                    <div class="form-help">
                        <?php echo __('formato_imagen'); ?>
                    </div>
                </div>
                
                <div class="d-flex gap-10 mt-20">
                    <button type="submit" class="w-100">✅ <?php echo __('guardar'); ?></button>
                    <a href="index.php" class="w-100 text-center">❌ <?php echo __('cancelar'); ?></a>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        // Validación en tiempo real del nombre
        document.getElementById('nombre').addEventListener('blur', function() {
            const nombre = this.value.trim();
            const tipo = document.getElementById('tipo').value;
            
            if (nombre && tipo) {
                // Aquí podrías añadir una llamada AJAX para validar en tiempo real
                console.log('Validando:', nombre, tipo);
            }
        });
        
        // Cambiar el mensaje según el tipo seleccionado
        document.getElementById('tipo').addEventListener('change', function() {
            const tipo = this.value;
            const nombre = document.getElementById('nombre').value;
            
            if (nombre && tipo) {
                // Actualizar mensaje de ayuda
                const helpText = document.querySelector('.form-help:last-of-type');
                if (helpText) {
                    helpText.textContent = '<?php echo __('regla_tipo_seleccionado'); ?>: ' + 
                        (tipo === 'llaves' ? '<?php echo __('llaves'); ?>' : 
                         tipo === 'bolso' ? '<?php echo __('bolso'); ?>' : 
                         '<?php echo __('mochila'); ?>');
                }
            }
        });
    </script>
</body>
</html>