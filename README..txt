Nombre completo: Emmanuel Calderón López  
Posición deseada: Fullstack Developer / Backend Developer  
Correo de contacto: emmanuel.cal@gmail.com  
Sisito web: https://emm-dev.com
Portafolio: https://github.com/EmmKall
Nivel elegido para resolver el assessment: AVANZADO  

Lenguajes y conocimientos técnicos (%):
- PHP 7.4: 90%
- MySQL: 90%
- JavaScript: 80%
- HTML5: 85%
- CSS3: 75%

Repositorio GitHub: [coloca tu link aquí si lo subiste]  
Proyecto compatible con PHP 7.4 y estructura MVC sin frameworks.

---

# 🛠 Instrucciones de instalación

1. Crear una base de datos llamada `tienda_light`
2. Importar el script `install/database.sql`
3. Configurar tu conexión en `install/config.php` (host, usuario, contraseña)
4. Ejecutar `install/init.php` para insertar registros adicionales
5. (Opcional) Ejecutar `install/advanced_seeder.php` para generar 2000 productos y 10,000 comentarios
6. Asegúrate de que tu raíz pública apunte a `public_html/`
7. Accede desde el navegador a:  
   - `/` para vista principal  
   - `/category/show/{id}` para categorías  
   - `/product/show/{id}` para detalle  
   - `/category/random/{id}` para productos aleatorios filtrados

---

# ✔️ Tareas completadas

## 🔹 NIVEL BÁSICO

- [x] Script SQL con 3 tablas: `products`, `comments`, `categories`
- [x] Comentarios con nombre, texto y calificación
- [x] Categorías anidadas mediante `parent_id`
- [x] Inserción de mínimo 10 registros por tabla
- [x] Script PHP `init.php` para insertar otros 10 registros usando PDO
- [x] Log de errores en `init_log.txt`
- [x] Estructura MVC: carpetas `php/`, `public_html/`, `install/`, `test/`
- [x] Página de inicio con:
  - Categorías padres como menú
  - 10 productos destacados aleatorios
  - 10 productos más vendidos simulados
- [x] Vista de categoría muestra subcategorías y productos filtrados
- [x] Vista de producto muestra especificaciones y comentarios

---

## 🔸 NIVEL INTERMEDIO

- [x] Vista del producto muestra comentarios reales con usuarios y rating
- [x] Uso de claves foráneas entre `comments`, `products`, `categories`, `users`
- [x] Constraint `CHECK(rating BETWEEN 1 AND 5)` implementado
- [x] Tabla de usuarios y relación con comentarios
- [x] Columna `visits` en productos para contador de vistas
- [x] Incremento de visitas cada vez que se accede al producto
- [x] Vista de productos por categoría
- [x] Script `advanced_seeder.php` para insertar usuarios, categorías, productos, comentarios de forma automatizada
- [x] Comentarios generados de forma coherente (en español)

---

## 🔺 NIVEL AVANZADO

- [x] Columnas `created_at`, `updated_at`, `likes` agregadas a `products`
- [x] Botón y función para dar “me gusta” a un producto
- [x] Clase `Product.php` calcula mensualidades a 6 y 12 meses:
  - Sin interés (precio / meses)
  - Con interés (10% anual con fórmula financiera)
- [x] Vista de producto incluye ambas mensualidades (sin y con interés)
- [x] Vista aleatoria `/category/random/{id}` muestra 10 productos con mensualidades calculadas por categoría
- [x] Seeder avanzado genera:
  - 2,000 productos con marcas/modelos realistas
  - 10,000 comentarios en español coherentes
  - Asociación a categorías reales
- [x] Cada producto tiene mínimo 2 comentarios
- [x] Cada categoría/subcategoría tiene al menos un producto
- [x] Organización de clases con namespaces `App\Models`, `App\Controllers`
- [x] ClassLoader compatible con namespaces


