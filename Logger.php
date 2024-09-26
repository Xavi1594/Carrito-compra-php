<?php

class Logger {
    private $filename;

    // Constructor que recibe el nombre del archivo de log.
    public function __construct($filename) {
        $this->filename = $filename;
    }

    // Método para registrar errores en el archivo CSV.
    public function error($message) {
        // Abre el archivo en modo append y escribe la fecha, el nivel y el mensaje en formato CSV
        $line = [date('Y-m-d H:i:s'), 'ERROR', $message];
        $file = fopen($this->filename, 'a'); // 'a' para añadir al final del archivo
        fputcsv($file, $line); // Escribe la línea en formato CSV
        fclose($file); // Cierra el archivo
    }
}
