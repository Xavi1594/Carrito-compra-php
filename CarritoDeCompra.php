<?php

class CarritoDeCompraException extends Exception {}

class CarritoDeCompra {
    private $productos;

    public function __construct() {
        $this->productos = [];
    }

    public function agregarProducto(Producto $producto, $cantidad = 1) {
        try {
            if ($cantidad <= 0) {
                throw new InvalidArgumentException("La cantidad debe ser mayor a cero.");
            }
            // Se usa SKU como identificador único
            $identificador = $producto->getSku(); 
    
            // Si el producto no está en el carrito, se inicializa 
            if (!isset($this->productos[$identificador])) {
                $this->productos[$identificador] = ['producto' => $producto, 'cantidad' => 0];
            }
    
            // Aumenta la cantidad de productos
            $this->productos[$identificador]['cantidad'] += $cantidad;
    
        } catch (InvalidArgumentException $e) {
            $logger = new Logger('carrito.log');
            $logger->error($e->getMessage());
            throw new CarritoDeCompraException("Error al agregar producto: " . $e->getMessage());
        }
    }
    

    public function calcularTotal() {
        return array_sum(array_map(function($item) {
            return $item['cantidad'] * $item['producto']->getPrecio();
        }, $this->productos));
    }

    public function eliminarProducto($identificador) {
        if (isset($this->productos[$identificador])) {
            if ($this->productos[$identificador]['cantidad'] > 1) {
                $this->productos[$identificador]['cantidad'] -= 1;
            } else {
                unset($this->productos[$identificador]);
            }
        }
    }

    public function getItems() {
        return $this->productos;
    }
}
