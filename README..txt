Nombre completo: Emmanuel Calderón López  
Posición deseada: Fullstack Developer / Backend Developer  
Correo de contacto: emmanuel.cal@gmail.com  
Sitio web: https://emm-dev.com
Portafolio: https://github.com/EmmKall
Nivel elegido para resolver el assessment: AVANZADO

Lenguajes y conocimientos técnicos (%):
- PHP 7.4: 90%
- MySQL: 90%
- JavaScript: 80%
- HTML5: 85%
- CSS3: 75%

Repositorio GitHub: https://github.com/EmmKall/assessment-light-agency
Este proyecto está desarrollado en **PHP 7.4**, **MySQL 5.7+**, **HTML5**, **CSS3** y **JavaScript puro**, con estructura MVC sin frameworks.

### ✅ Requisitos

- PHP 7.4 o superior
- Servidor local (Apache/Nginx)
- MySQL 5.7 o superior
- Navegador web moderno
- Opcional: XAMPP, MAMP, Laragon, en este caso se hizo uso de Laragon

---

### 📁 Estructura esperada del proyecto

/root_project/
├── public_html/ # Carpeta pública (htdocs o www)
│ ├── index.php # Punto de entrada
│ ├── views/ # Todas las vistas y parciales
│ └── images/ # Imágenes de productos (webp)
├── php/
│ ├── controllers/
│ ├── models/
│ ├── core/
│ └── seeders/
│ └── advanced_seeder.php
├── database/
│ └── dump.sql

---

### ⚙️ Configuración del entorno

1. Clona o descarga el proyecto en tu servidor local:
   - Si usas XAMPP, coloca todo dentro de `htdocs`
   - Si usas Laragon o MAMP, dentro del directorio público correspondiente

# 🛠 Instrucciones de instalación

1. Crear una base de datos llamada `ecommerce`
2. Importar el script `install/database.sql`.
3. Configurar tu conexión en `install/config.php` (host, usuario, contraseña):
  $host = 'localhost';
  $db   = 'ecommerce';
  $user = 'root';
  $pass = '';
4. Ejecutar `install/init.php` para insertar registros adicionales
  php php/install/init.php
5. (Opcional) Ejecutar `install/advanced_seeder.php` para generar 2000 productos y 10,000 comentarios
  php php/install/advanced_seeder.php
6. Asegúrate de que tu raíz pública apunte a `public_html/`
7. Accede desde el navegador a:  
   - `/` para vista principal  
   - `/auth/login` para autenticarse, usar usuarios registrados en la tabla de users, ejemplo: carlos.ramirez@example.com
   - `/category/show/{id}` para categorías  
   - `/product/show/{id}` para detalle  
   - `/category/random/{id}` para productos aleatorios filtrados
   - `/productmanager/form` para crear producto
   - Las demás rutas estan declaradas más abajo de este documento

---

# ✔️ Tareas completadas

## 🔹 NIVEL BÁSICO

- [x] Crear base de datos con las tablas `products`, `categories`, `comments`
- [x] Crear estructura MVC sin frameworks
- [x] Mostrar productos aleatorios (`category_random.php`)
- [x] Mostrar productos por categoría (`category.php`)
- [x] Mostrar detalles de producto (`product.php`)
- [x] Mostrar productos con sus comentarios
- [x] Contador de visitas por producto
- [x] Generar datos de prueba de productos y comentarios
- [x] Incluir imagen del producto según su marca (Acer, Apple, etc.)
- [x] Imagen por defecto si no hay coincidencia (`base.webp`)
- [x] Página responsive para desktop y móvil
- [x] Header y footer reutilizables
- [x] Filtro de búsqueda por nombre de producto

---

## 🔸 NIVEL INTERMEDIO

- [x] Tabla `categories` anidada (padre/hijo)
- [x] Relación `products → categories` (con padres e hijos)
- [x] Relación `comments → products`
- [x] Tabla `users` (id, name, last_name, email)
- [x] Relación `comments → users`
- [x] Vista de producto con comentarios y nombre de usuario
- [x] Panel de login de usuario
- [x] Sistema de sesión (`AuthController`)
- [x] Mostrar opciones solo si el usuario está logueado
- [x] Protección de rutas (crear/editar producto solo si hay sesión activa)
- [x] Vista de formulario para crear y editar productos (`product_form.php`)
- [x] Controlador para guardar productos nuevos o actualizados
- [x] Mostrar datos actualizados correctamente

---

## 🔺 NIVEL AVANZADO

- [x] Script para carga masiva de productos con relaciones correctas (`advanced_seeder.php`)
- [x] Generación automática de marca, modelo y categoría al insertar productos
- [x] Imágenes asignadas automáticamente según marca
- [x] Sección de búsqueda con filtros avanzados:
  - Nombre del producto (LIKE)
  - Categoría
  - Precio mínimo y máximo
- [x] Resultados responsivos y reutilizables

- [x] Script para carga masiva de productos con relaciones correctas (`advanced_seeder.php`)
- [x] Generación automática de marca, modelo y categoría al insertar productos
- [x] Imágenes asignadas automáticamente según marca
- [x] Sección de búsqueda con filtros avanzados:
  - Nombre del producto (LIKE)
  - Categoría
  - Precio mínimo y máximo
- [x] Resultados responsivos y reutilizables
- [x] Agregar comentarios si está logueado
- [x] Logueo de usuarios

---


## 🌐 Rutas del Sistema

### 🏠 Público general

| Ruta                         | Método | Descripción                                 |
|------------------------------|--------|---------------------------------------------|
| `/`                          | GET    | Página de inicio, productos destacados      |
| `/category/show/{id}`        | GET    | Ver productos por categoría padre o hija    |
| `/category/random`           | GET    | Ver productos aleatorios                    |
| `/product/show/{id}`         | GET    | Ver detalle del producto y sus comentarios  |
| `/product/search`            | GET    | Buscar productos con filtros                |

---

### 👤 Autenticación

| Ruta                  | Método | Descripción                        |
|-----------------------|--------|------------------------------------|
| `/auth/loginform`     | GET    | Mostrar formulario de login        |
| `/auth/login`         | POST   | Procesar login (por email)         |
| `/auth/logout`        | GET    | Cerrar sesión                      |

---

### 🛠️ Administración de productos (requiere login)

| Ruta                            | Método | Descripción                              |
|---------------------------------|--------|------------------------------------------|
| `/productmanager/form`          | GET    | Mostrar formulario para crear producto   |
| `/productmanager/form/{id}`     | GET    | Mostrar formulario para editar producto  |
| `/productmanager/save`          | POST   | Guardar producto nuevo o editado         |
