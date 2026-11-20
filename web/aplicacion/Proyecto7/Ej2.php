<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(dirname(__FILE__) . "/../../scripts/funciones.php");

//Controlador
$barra = [
    ["TEXTO" => "inicio",    "ENLACE" => "/index.php"],
    ["TEXTO" => "Proyecto7", "ENLACE" => "/aplicacion/Proyecto7/index.php"],
    ["TEXTO" => "Ej2",       "ENLACE" => "/aplicacion/Proyecto7/Ej2.php"]
];

$puntos = cargarPuntos();
if (!file_exists(rutaImagen())) guardarImagen($puntos);   // imagen inicial

$valores = ['x' => '', 'y' => '', 'color' => '', 'grosor' => ''];
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Añadir punto
    if (isset($_POST['guardar'])) {
        foreach ($valores as $campo => $_) {
            $valores[$campo] = trim($_POST[$campo] ?? '');
        }
        foreach (['x', 'y'] as $c) {
            $n = filter_var($valores[$c], FILTER_VALIDATE_INT);
            if ($n === false || $n < 0 || $n > 500) {
                $errores[$c] = "Debe ser un entero entre 0 y 500";
            }
        }
        if (!array_key_exists($valores['color'], Punto::COLORES)) {
            $errores['color'] = "Selecciona un color";
        }
        $g = filter_var($valores['grosor'], FILTER_VALIDATE_INT);
        if ($g === false || !array_key_exists($g, Punto::GROSORES)) {
            $errores['grosor'] = "Selecciona un grosor";
        }

        if (!$errores) {
            try {
                $puntos[] = new Punto((int)$valores['x'], (int)$valores['y'], $valores['color'], $g);
                guardarPuntos($puntos);
                guardarImagen($puntos);
                header('Location: Ej2.php');
                exit;
            } catch (InvalidArgumentException $e) {
                $errores['x'] = $e->getMessage();
            }
        }
    }

    // 4. Borrar punto
    if (isset($_POST['borrar'])) {
        $i = filter_var($_POST['punto'] ?? '', FILTER_VALIDATE_INT);
        if ($i !== false && isset($puntos[$i])) {
            array_splice($puntos, $i, 1);
            guardarPuntos($puntos);
            guardarImagen($puntos);
        }
        header('Location: Ej2.php');
        exit;
    }

    // 6. Subir fichero de puntos
    if (isset($_POST['subir'])) {
        $añadidos = 0;
        if (isset($_FILES['fichero']) && $_FILES['fichero']['error'] === UPLOAD_ERR_OK) {
            $lineas = file($_FILES['fichero']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lineas as $linea) {
                $p = lineaAPunto($linea);
                if ($p !== null) {
                    $puntos[] = $p;
                    $añadidos++;
                }
            }
            if ($añadidos > 0) {
                guardarPuntos($puntos);
                guardarImagen($puntos);
            }
        }
        header('Location: Ej2.php?subidos=' . $añadidos);
        exit;
    }
}

$urlImagen = '/imagenes/puntos/' . basename(rutaImagen()) . '?t=' . @filemtime(rutaImagen());

//dibuja la plantilla de la vista
inicioCabecera("Ej2");
cabecera();
finCabecera();
inicioCuerpo("Ej2", $barra);
cuerpo($valores, $errores, $puntos, $urlImagen);  //llamo a la vista
finCuerpo();
// **********************************************************

// Muestra el error de un campo solo si existe (así no sale la caja vacía)
function mostrarError($errores, $campo)
{
    if (isset($errores[$campo])) {
        echo '<span class="error">' . htmlspecialchars($errores[$campo]) . '</span>';
    }
}

//vista
function cabecera()
{
?>
    <!-- esto va en el head -->
<?php
}

//vista
function cuerpo($valores, $errores, $puntos, $urlImagen)
{
?>
    <main id="main">
        <br><br>

        <h2>Nuevo punto</h2>
        <form method="post" action="Ej2.php">
            <fieldset>
                <label for="x">Coordenada X</label>
                <input type="number" id="x" name="x" value="<?= htmlspecialchars($valores['x']) ?>" min="0" max="500">
                <?php mostrarError($errores, 'x'); ?> <br>

                <label for="y">Coordenada Y</label>
                <input type="number" id="y" name="y" value="<?= htmlspecialchars($valores['y']) ?>" min="0" max="500">
                <?php mostrarError($errores, 'y'); ?> <br>

                <select name="color">
                    <option value="">-- elige --</option>
                    <?php foreach (Punto::COLORES as $clave => $datos): ?>
                        <option value="<?= $clave ?>" <?= $valores['color'] === $clave ? 'selected' : '' ?>>
                            <?= $datos['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php mostrarError($errores, 'color'); ?> <br>

                <?php foreach (Punto::GROSORES as $clave => $nombre): ?>
                    <label>
                        <input type="radio" name="grosor" value="<?= $clave ?>"
                            <?= $valores['grosor'] == $clave ? 'checked' : '' ?>>
                        <?= $nombre ?>
                    </label>
                <?php endforeach; ?>
                <?php mostrarError($errores, 'grosor'); ?> <br>

                <button type="submit" name="guardar">Guardar</button>
            </fieldset>
        </form>

        <h2>Puntos</h2>
        <textarea rows="8" cols="40" readonly><?php
            foreach ($puntos as $p) echo htmlspecialchars(puntoALinea($p)), "\n";
        ?></textarea>
        <p><img src="<?= $urlImagen ?>" alt="Puntos"></p>
        <p><a href="imagen.php">Descargar imagen</a></p>

        <h2>Borrar punto</h2>
        <form method="post" action="Ej2.php">
            <select name="punto">
                <?php foreach ($puntos as $i => $p): ?>
                    <option value="<?= $i ?>"><?= htmlspecialchars(puntoALinea($p)) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="borrar">Borrar</button>
        </form>

        <h2>Subir puntos</h2>
        <form method="post" action="Ej2.php" enctype="multipart/form-data">
            <input type="file" name="fichero" accept=".txt">
            <button type="submit" name="subir">Subir</button>
        </form>
        <?php if (isset($_GET['subidos'])): ?>
            <p>Puntos añadidos: <?= (int)$_GET['subidos'] ?></p>
        <?php endif; ?>
    </main>
<?php
}