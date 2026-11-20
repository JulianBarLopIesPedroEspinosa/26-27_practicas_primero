<?php
require_once __DIR__ . '/../../scripts/funciones.php';

$puntos = cargarPuntos();

// Se crea al vuelo, sin leer ningún fichero de imagen
header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename="puntos.jpg"');
imagejpeg(crearImagen($puntos), null, 90);