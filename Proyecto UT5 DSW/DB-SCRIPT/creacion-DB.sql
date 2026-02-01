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
    imagen VARCHAR(255)
);

CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    producto_id INT,
    cantidad INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

INSERT INTO usuarios (usuario, password, rol)
SELECT 'admin', 
       '$2y$10$25zQOOAo2UESzPksFA6tsuOIsUJu5yBHckQkIr5BR6Uu4Br3C0i3W',
       'admin'
WHERE NOT EXISTS (
    SELECT 1 FROM usuarios WHERE usuario = 'admin'
);

drop database tienda_llaveros;

select * from carrito;

select * from usuarios;
