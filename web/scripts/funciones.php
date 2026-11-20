<?php
require_once __DIR__ . '/clases/Punto.php';

const RAIZ = __DIR__ . '/..';

function sufijoCliente(): string
{
    $ip = str_replace(['.', ':'], '_', $_SERVER['REMOTE_ADDR'] ?? 'local');
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $nav = 'otro';
    // El orden importa: Edge y Opera también dicen "Chrome"
    foreach (['Edg' => 'edge', 'OPR' => 'opera', 'Firefox' => 'firefox',
              'Chrome' => 'chrome', 'Safari' => 'safari'] as $clave => $nombre) {
        if (stripos($ua, $clave) !== false) { $nav = $nombre; break; }
    }
    return "{$ip}_{$nav}";
}

function rutaDat(): string    { return RAIZ . '/datos/puntos_' . sufijoCliente() . '.dat'; }
function rutaImagen(): string { return RAIZ . '/imagenes/puntos/imagen_' . sufijoCliente() . '.jpg'; }

// "x ; y ; color ; grosor" -> Punto o null si no es válido
function lineaAPunto(string $linea): ?Punto
{
    $partes = array_map('trim', explode(';', $linea));
    if (count($partes) !== 4) return null;

    $x = filter_var($partes[0], FILTER_VALIDATE_INT);
    $y = filter_var($partes[1], FILTER_VALIDATE_INT);
    $g = filter_var($partes[3], FILTER_VALIDATE_INT);
    if ($x === false || $y === false || $g === false) return null;
    if ($x < 0 || $x > 500 || $y < 0 || $y > 500) return null;

    try {
        return new Punto($x, $y, $partes[2], $g);
    } catch (InvalidArgumentException $e) {
        return null;
    }
}

function puntoALinea(Punto $p): string
{
    return "{$p->getX()} ; {$p->getY()} ; {$p->getColor()} ; {$p->getGrosor()}";
}

function guardarPuntos(array $puntos): void
{
    $ruta = rutaDat();
    if (!is_dir(dirname($ruta))) mkdir(dirname($ruta), 0775, true);
    $lineas = array_map('puntoALinea', $puntos);
    file_put_contents($ruta, $lineas ? implode(PHP_EOL, $lineas) . PHP_EOL : '', LOCK_EX);
}

function cargarPuntos(): array
{
    $ruta = rutaDat();
    if (!file_exists($ruta)) {
        // Primera visita: 3 puntos iniciales (se pueden quitar en el siguiente ejercicio)
        $iniciales = [
            new Punto(100, 100, 'red', 1),
            new Punto(250, 200, 'blue', 2),
            new Punto(400, 350, 'green', 3),
        ];
        guardarPuntos($iniciales);
        return $iniciales;
    }
    $puntos = [];
    foreach (file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
        $p = lineaAPunto($linea);
        if ($p !== null) $puntos[] = $p;
    }
    return $puntos;
}

// Dibuja los puntos con GD (fondo blanco + marco)
function crearImagen(array $puntos): GdImage
{
    $im = imagecreatetruecolor(501, 501);
    imagefill($im, 0, 0, imagecolorallocate($im, 255, 255, 255));
    imagerectangle($im, 0, 0, 500, 500, imagecolorallocate($im, 0, 0, 0));

    foreach ($puntos as $p) {
        [$r, $g, $b] = Punto::COLORES[$p->getColor()]['rgb'];
        $color = imagecolorallocate($im, $r, $g, $b);
        $d = 4 + 4 * $p->getGrosor();
        imagefilledellipse($im, $p->getX(), $p->getY(), $d, $d, $color);
    }
    return $im;
}

// Guarda la imagen en /imagenes/puntos/ (solo se llama al añadir/borrar/subir)
function guardarImagen(array $puntos): void
{
    $ruta = rutaImagen();
    if (!is_dir(dirname($ruta))) mkdir(dirname($ruta), 0775, true);
    imagejpeg(crearImagen($puntos), $ruta, 90);
}