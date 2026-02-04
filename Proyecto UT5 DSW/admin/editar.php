<?php
session_start();
require_once '../config/autoload.php';

if ($_SESSION['rol'] !== 'admin') die(__('error_acceso_denegado'));

$id = $_GET['id'];
$producto = Producto::findById($id);

if (!$producto) die(__('error_producto_no_encontrado'));

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $precio = floatval($_POST['precio']);
    $tipo = $_POST['tipo'];
    
    // Validar nombre no vacío
    if (empty($nombre)) {
        $error = __("error_nombre_vacio");
    }
    // Validar precio positivo
    elseif ($precio <= 0) {
        $error = __("error_precio_invalido");
    }
    // Validar que no exista otro producto con mismo nombre y tipo
    elseif (Producto::nombreTipoExiste($nombre, $tipo, $id)) {
        $error = __("error_nombre_tipo_duplicado");
    } else {
        // Actualizar producto
        $producto->setNombre($nombre);
        $producto->setPrecio($precio);
        $producto->setTipo($tipo);

        // Procesar nueva imagen si se subió
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            // Eliminar imagen anterior si existe
            if ($producto->getImagen() && file_exists('../uploads/' . $producto->getImagen())) {
                unlink('../uploads/' . $producto->getImagen());
            }
            
            $imagen = time() . '_' . $_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], '../uploads/' . $imagen);
            $producto->setImagen($imagen);
        }

        try {
            if ($producto->save()) {
                $success = __("exito_producto_actualizado");
            } else {
                $error = __("error_actualizar_producto");
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
    <title><?php echo __('editar_producto'); ?></title>
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
        
        .current-image {
            border: 2px dashed;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="container">
        <div class="preferencias-container">
            <h2 class="text-center"><?php echo __('editar_producto'); ?></h2>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <strong>❌ <?php echo __('error'); ?>:</strong> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="success-message">
                    <strong>✅ <?php echo __('exito'); ?>:</strong> <?php echo $success; ?>
                    <div class="mt-10">
                        <a href="index.php"><?php echo __('volver_listado'); ?></a>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (!$success): ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre"><?php echo __('nombre'); ?> *</label>
                    <input type="text" id="nombre" name="nombre" 
                           value="<?= htmlspecialchars($producto->getNombre()) ?>" 
                           required>
                    <div class="form-help">
                        <?php echo __('regla_nombre_tipo'); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="precio"><?php echo __('precio'); ?> (€) *</label>
                    <input type="number" id="precio" name="precio" step="0.01" 
                           value="<?= $producto->getPrecio() ?>" 
                           required min="0.01">
                </div>
                
                <div class="form-group">
                    <label for="tipo"><?php echo __('tipo'); ?> *</label>
                    <select id="tipo" name="tipo" required>
                        <option value="llaves" <?= $producto->getTipo()=='llaves'?'selected':'' ?>>
                            <?php echo __('llaves'); ?>
                        </option>
                        <option value="bolso" <?= $producto->getTipo()=='bolso'?'selected':'' ?>>
                            <?php echo __('bolso'); ?>
                        </option>
                        <option value="mochila" <?= $producto->getTipo()=='mochila'?'selected':'' ?>>
                            <?php echo __('mochila'); ?>
                        </option>
                    </select>
                    <div class="form-help">
                        <?php echo __('regla_tipo_unico'); ?>
                    </div>
                </div>
                
                <?php if ($producto->getImagen()): ?>
                    <div class="form-group">
                        <label><?php echo __('imagen_actual'); ?>:</label>
                        <div class="current-image">
                            <img src="../uploads/<?= $producto->getImagen() ?>" width="150" class="img-thumbnail">
                            <div class="mt-10">
                                <small><?php echo __('mantener_imagen'); ?></small>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="imagen"><?php echo __('nueva_imagen'); ?>:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                    <div class="form-help">
                        <?php echo __('formato_imagen'); ?>
                    </div>
                </div>
                
                <div class="d-flex gap-10 mt-20">
                    <button type="submit" class="w-100">✅ <?php echo __('actualizar'); ?></button>
                    <a href="index.php" class="w-100 text-center">❌ <?php echo __('cancelar'); ?></a>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        // Validación en tiempo real
        document.getElementById('nombre').addEventListener('blur', function() {
            const nombre = this.value.trim();
            const tipo = document.getElementById('tipo').value;
            const id = <?= $id ?>;
            
            if (nombre && tipo) {
                // Aquí podrías añadir una llamada AJAX para validar en tiempo real
                console.log('Validando edición:', nombre, tipo, id);
            }
        });
    </script>
</body>
</html>