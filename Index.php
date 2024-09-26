<?php
require_once 'Producto.php';
require_once 'CarritoDeCompra.php';
require_once 'Logger.php';



// Iniciar sesión
session_start();

// Verifica si ya existe un carrito en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = new CarritoDeCompra();
}

$carrito = $_SESSION['carrito'];

// Productos iniciales
$producto1 = new Producto("Camisa", 15.99);
$producto2 = new Producto("Pantalones", 49.99);
$producto3 = new Producto("Zapatos", 79.99);

try {
    // Se añaden los productos iniciales al carrito si aún no están
    if (empty($carrito->getItems())) {
        $carrito->agregarProducto($producto1, 2);
        $carrito->agregarProducto($producto2, 1);
        $carrito->agregarProducto($producto3, 3);
    }
} catch (CarritoDeCompraException $e) {
    echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
}

//  eliminación de productos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
    $identificadorEliminar = $_POST['identificador'];
    $carrito->eliminarProducto($identificadorEliminar);
    $mensajeExito = "Producto eliminado con éxito.";
}

//  creación de nuevos productos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear'])) {
    $nombreNuevo = $_POST['nombre'];
    $precioNuevo = $_POST['precio'];
    $nuevoProducto = new Producto($nombreNuevo, $precioNuevo);
    $carrito->agregarProducto($nuevoProducto, 1);
    $mensajeExito = "Producto '$nombreNuevo' añadido con éxito al carrito.";
}

$total = $carrito->calcularTotal();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compra</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Carrito de Compra</h1>
    </header>

    <main>
        <div class="cart-content-wrapper">
            <?php if (isset($mensajeExito)) : ?>
                <p class="success"><?php echo $mensajeExito; ?></p>
                <script>
                    setTimeout(function() {
                        var successMessage = document.querySelector('.success');
                        if (successMessage) {
                            successMessage.style.display = 'none'; // Oculta el mensaje
                        }
                    }, 4000); // 4000 ms = 4 segundos
                </script>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>Nombre del producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carrito->getItems() as $identificador => $item) : ?>
                        <tr>
                            <td><?php echo $item['producto']->getNombre(); ?></td>
                            <td><?php echo number_format($item['producto']->getPrecio(), 2); ?>€</td>
                            <td><?php echo $item['cantidad']; ?></td>
                            <td><?php echo number_format($item['cantidad'] * $item['producto']->getPrecio(), 2); ?>€</td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="identificador" value="<?php echo $identificador; ?>">
                                    <button type="submit" name="eliminar" 
                                            style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 5px;">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total">
                Total: <?php echo number_format($total, 2);  ?>€
            </div>

            <h2>Añadir Nuevo Producto</h2>
            <form method="POST" class="cart-actions">
                <input type="text" name="nombre" placeholder="Nombre del producto" required>
                <input type="number" name="precio" placeholder="Precio" step="0.01" required>
                <button type="submit" name="crear">Crear Producto</button>
            </form>
        </div>
    </main>
</body>
</html>
