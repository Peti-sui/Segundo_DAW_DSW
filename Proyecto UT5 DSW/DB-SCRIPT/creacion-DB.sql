CREATE DATABASE tienda_llaveros;
USE tienda_llaveros;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    precio DECIMAL(6,2),
    tipo ENUM('llaves','bolso','mochila'),
    imagen VARCHAR(255),
    -- RESTRICCIÓN ÚNICA: No puede haber dos productos con mismo nombre y tipo
    UNIQUE KEY unique_nombre_tipo (nombre, tipo)
);

CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    producto_id INT,
    cantidad INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

-- Insertar usuario admin si no existe
INSERT INTO usuarios (usuario, password, rol)
SELECT 'admin', 
       '$2y$10$25zQOOAo2UESzPksFA6tsuOIsUJu5yBHckQkIr5BR6Uu4Br3C0i3W',
       'admin'
WHERE NOT EXISTS (
    SELECT 1 FROM usuarios WHERE usuario = 'admin'
);

-- Para eliminar la base de datos (cuidado, borra todo)
DROP DATABASE tienda_llaveros;

-- Consultas útiles para testing
SELECT * FROM usuarios;
SELECT * FROM productos;
SELECT * FROM carrito;

-- Consulta para verificar la restricción única
SELECT nombre, tipo, COUNT(*) as cantidad 
FROM productos 
GROUP BY nombre, tipo 
HAVING cantidad > 1;
