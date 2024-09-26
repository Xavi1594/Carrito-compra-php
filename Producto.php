<?php
class Producto {
    private $nombre;
    private $sku;
    private $precio;

    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->sku = uniqid();
        $this->precio = $precio;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }
    public function getSku() {
        return $this->sku;
}
}

