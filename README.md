<h1>Tn Toys - Jugueteria</h1>
<p>Tn Toys es Una plataforma de comercio electrónico diseñada para la venta y gestión del catálogo de una juguetería. Este proyecto implementa un sistema completo que abarca desde la exploración de productos para los clientes hasta la administración del inventario (CRUD) para los administradores.</p>

<img width="1906" height="908" alt="image" src="https://github.com/user-attachments/assets/c4e203cc-21d9-4863-89bc-b3b701eac849" />


<h3>Caracteristicas principales</h3>
<ul>
    <li>Catálogo de Productos: Visualización de juguetes con detalles, imágenes, precios y filtrado por categorías.</li>
    <li>Gestión de Inventario: Panel de administración integrado para crear, leer, actualizar y eliminar productos.</li>
    <li>Carrito de Compras: Sistema dinámico para que los usuarios añadan, revisen y gestionen los artículos antes de finalizar la compra.</li>
    <li>Autenticación y Roles: Sistema seguro de registro e inicio de sesión para clientes y administradores.</li>
</ul>

<h3>Tecnologias utilizadas</h3>
<ul>
    <li>Backend: PHP & Laravel</li>
    <li>Base de Datos: MariaDB</li>
    <li>Frontend: Bootstrap & Blade (Motor de plantillas de Laravel)</li>
    <li>Control de Versiones: Git y GitHub</li>
</ul>

<h2>Instalación y uso local del proyecto</h2>

Paso 1 - Clonar el repositorio
```bash
git clone https://github.com/nahi-ayk/grupo22.git
```

Paso 2 - Descargar dependencias del proyecto
```bash
composer install
```

Paso 3 - Copiar .env en .env.example
```bash
cp .env.example .env
```

Paso 4 - Importar el dump de MariaDB

Paso 5 - Generar clave
```bash
php artisan key:generate
```

Paso 6 - Verificar credenciales de la base de datos MariaDB
```bash
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_grupo22
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

<h3>IMPORTANTE</h3>
<p>Ejecutar composer install es de vital importancia ya que instalara todos los archivos necesarios para que el proyecto funcione correctamente.</p>






