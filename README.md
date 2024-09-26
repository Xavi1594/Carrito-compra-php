# Carrito de Compras PHP

Este proyecto es una implementación sencilla de un carrito de compras en PHP. Permite a los usuarios agregar, eliminar y calcular el total de productos en su carrito, así como registrar errores en un archivo CSV.

## Estructura del Proyecto

- **Producto.php**: Clase que representa un producto, incluyendo su nombre, SKU (identificador único) y precio.
- **CarritoDeCompra.php**: Clase que maneja la lógica del carrito de compras, permitiendo agregar y eliminar productos, así como calcular el total.
- **Logger.php**: Clase encargada de registrar errores en un archivo CSV.
- **index.php**: Archivo principal que gestiona la sesión del usuario y la interacción con el carrito de compras a través de un formulario HTML.

## Requisitos

- PHP 7.0 o superior
- Un servidor web con soporte para PHP (como Apache o Nginx)

## Instalación

1. Clona el repositorio en tu máquina local.
2. Asegúrate de tener un servidor web configurado con PHP.
3. Coloca los archivos en el directorio raíz de tu servidor web.
4. Accede a `index.php` desde tu navegador.

## Funcionalidades

### 1. Manejo de Productos

- **Agregar Productos**: Puedes agregar productos al carrito mediante un formulario. Al agregar un producto, se genera un SKU único para identificarlo.
- **Eliminar Productos**: Los productos pueden ser eliminados uno por uno. Si la cantidad es mayor a uno, se reduce en uno; de lo contrario, se elimina el producto del carrito.

### 2. Cálculo del Total

- El total del carrito se calcula automáticamente en función de los productos y sus cantidades.

### 3. Registro de Errores

- Los errores que ocurren al intentar agregar productos (como ingresar una cantidad inválida) se registran en un archivo CSV. Esto permite un seguimiento fácil de problemas en el funcionamiento de la aplicación.

### 4. Interfaz de Usuario

- La interfaz de usuario es simple y está diseñada para permitir una fácil interacción con el carrito de compras. Incluye una tabla que muestra los productos, sus precios, cantidades y acciones disponibles.

## Ejemplo de Uso

Para agregar un producto al carrito:

1. Ingresa el nombre y el precio del producto en los campos proporcionados.
2. Haz clic en "Crear Producto".
3. El producto se añadirá al carrito y se mostrará en la tabla.

Para eliminar un producto del carrito:

1. Haz clic en el botón "Eliminar" junto al producto que deseas quitar.
2. El producto será eliminado de la tabla.

## Manejo de Errores

Los errores se registran en el archivo `carrito.log` en formato CSV. Cada línea contiene la fecha, el nivel de error (ERROR) y el mensaje de error.

## Notas

- Asegúrate de tener permisos de escritura en el directorio donde se crea el archivo de log para que los errores se registren correctamente.
- Puedes personalizar el diseño CSS mediante el archivo `styles.css`.

## Licencia

Este proyecto está bajo la Licencia MIT. Puedes usar, modificar y distribuir el código como desees, siempre que se incluya el aviso de licencia.

## Contribuciones

Las contribuciones son bienvenidas. Si deseas realizar mejoras o añadir nuevas funcionalidades, siéntete libre de abrir un "pull request".

