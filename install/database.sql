CREATE DATABASE IF NOT EXISTS ecommerce DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ecommerce;


#Usuarios
CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(20),
  last_name VARCHAR(20),
  email VARCHAR(50),
  PRIMARY KEY( id )
);

#categorias
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    parent_id INT DEFAULT NULL,
    FOREIGN KEY (parent_id) REFERENCES categories(id)
);

#Productos
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specifications TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category_id INT NOT NULL,
    brand VARCHAR(100),
    model VARCHAR(100),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);


#Comentarios
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    rating TINYINT CHECK (rating BETWEEN 1 AND 5),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

#Insertar usuarios
INSERT INTO users (name, last_name, email) VALUES
('Carlos', 'Ramírez', 'carlos.ramirez@example.com'),
('Lucía', 'Fernández', 'lucia.fernandez@example.com'),
('Pedro', 'López', 'pedro.lopez@example.com'),
('Ana', 'Gómez', 'ana.gomez@example.com'),
('Luis', 'Martínez', 'luis.martinez@example.com'),
('Marta', 'Jiménez', 'marta.jimenez@example.com'),
('Raúl', 'Sánchez', 'raul.sanchez@example.com'),
('Carmen', 'Díaz', 'carmen.diaz@example.com'),
('Sofía', 'Vega', 'sofia.vega@example.com'),
('Javier', 'Pérez', 'javier.perez@example.com');

#Insertar categorias
INSERT INTO categories (name, parent_id) VALUES
('Laptops', NULL),
('Gaming Laptops', 1),
('Ultrabooks', 1),
('Desktops', NULL),
('All-in-One', 4),
('Workstations', 4),
('Tablets', NULL),
('Convertible', 7),
('Chromebooks', 1),
('Servers', NULL);

# Insertar productos
INSERT INTO products (name, specifications, price, category_id, brand, model) VALUES
('HP Pavilion 15', 'Intel i5, 8GB RAM, 512GB SSD', 16500.00, 2, 'HP', 'Pavilion 15-eg0002la'),
('Dell G15', 'Ryzen 5, 16GB RAM, RTX 3050', 22500.00, 2, 'Dell', 'G15 5515'),
('MacBook Air M1', 'Apple M1, 8GB RAM, 256GB SSD', 27500.00, 3, 'Apple', 'Air M1'),
('Acer Aspire 5', 'Intel i3, 8GB RAM, 256GB SSD', 12500.00, 3, 'Acer', 'Aspire 5 A515'),
('HP Envy', 'Intel i7, 16GB RAM, 1TB SSD', 28500.00, 3, 'HP', 'Envy 13'),
('Lenovo Legion', 'i7, 32GB RAM, RTX 3070', 38500.00, 2, 'Lenovo', 'Legion 5 Pro'),
('iMac 24"', 'Apple M1, 8GB RAM, 256GB SSD', 33000.00, 5, 'Apple', 'iMac 24'),
('Dell OptiPlex', 'i5, 16GB RAM, 512GB SSD', 20500.00, 6, 'Dell', 'OptiPlex 7090'),
('Huawei MateBook', 'Ryzen 7, 16GB RAM, 512GB SSD', 19500.00, 3, 'Huawei', 'D15'),
('Chromebook Spin', 'Intel Celeron, 4GB RAM, 64GB eMMC', 8500.00, 9, 'Acer', 'Spin 311');

#Insertar comentarios
INSERT INTO comments (product_id, user_id, comment, rating) VALUES
(1, 1, 'Excelente laptop para uso diario.', 5),
(2, 2, 'Buena para gaming, aunque se calienta un poco.', 4),
(3, 3, 'Ideal para llevar a todos lados.', 5),
(4, 4, 'Perfecta para estudiantes.', 4),
(5, 5, 'Muy buen rendimiento.', 5),
(6, 6, 'Una bestia para juegos.', 5),
(7, 7, 'El diseño es increíble.', 4),
(8, 8, 'Silenciosa y rápida.', 5),
(9, 9, 'Excelente relación calidad-precio.', 4),
(10, 10, 'Ideal para navegar y tareas básicas.', 3);

ALTER TABLE products ADD COLUMN visits INT DEFAULT 0;

#Crear tabla acesorios
CREATE TABLE accessories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

#Insertar registros acesosrios
INSERT INTO accessories (name, description, category_id) VALUES
('Mouse inalámbrico', 'Mouse con conexión Bluetooth', 1),
('Teclado retroiluminado', 'Teclado RGB para gaming', 2),
('Soporte para laptop', 'Soporte ajustable para portátiles', 3);

#Agregar metainformación a productos
ALTER TABLE products
ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
ADD COLUMN likes INT DEFAULT 0;




