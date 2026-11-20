<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [
    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "Proyecto7",
        "ENLACE" => "/aplicacion/Proyecto7/index.php"
    ],
    [
        "TEXTO" => "Ej1",
        "ENLACE" => "/aplicacion/Proyecto7/Ej1.php"
    ]
];

$puntos  = [];
$valores = ["x" => "", "y" => "", "color" => "", "grosor" => ""];
$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($valores as $campo => $_) {
        $valores[$campo] = trim($_POST[$campo] ?? "");
    }

    foreach (["x", "y"] as $c) {
        $n = filter_var($valores[$c], FILTER_VALIDATE_INT);
        if ($n === false || $n < 0 || $n > 500) {
            $errores[$c] = "Debe ser un entero entre 0 y 500";
        }
    }

    if (!array_key_exists($valores["color"], Punto::COLORES)) {
        $errores["color"] = "Selecciona un color";
    }

    $g = filter_var($valores["grosor"], FILTER_VALIDATE_INT);
    if ($g === false || !array_key_exists($g, Punto::GROSORES)) {
        $errores["grosor"] = "Selecciona un grosor";
    }

    if (!$errores) {
        try {
            $puntos[] = new Punto((int)$valores["x"], (int)$valores["y"], $valores["color"], $g);
            $valores = ["x" => "", "y" => "", "color" => "", "grosor" => ""]; // limpiar formulario
        } catch (InvalidArgumentException $e) {
            $errores["x"] = $e->getMessage();
        }
    }
}

//dibuja la plantilla de la vista
inicioCabecera("Ej1");
cabecera();
finCabecera();
inicioCuerpo("Ej1", $barra);
cuerpo($valores, $errores);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>
    <!-- esto va en el head -->
<?php
}

//vista
function cuerpo($valores, $errores)
{
?>
    <main id="main">
        <br><br>
        <form method="post" action="Ej1.php">
            <fieldset>
                <label for="x">Coordenada X</label>
                <input type="number" id="x" name="x" value="<?= htmlspecialchars($valores["x"]) ?>" min="0" max="500">
                <?php if (isset($errores["x"])): ?>
                    <span class="error"><?= $errores["x"] ?></span>
                <?php endif; ?>

                <label for="y">Coordenada Y</label>
                <input type="number" id="y" name="y" value="<?= htmlspecialchars($valores["y"]) ?>" min="0" max="500">
                <?php if (isset($errores["y"])): ?>
                    <span class="error"><?= $errores["y"] ?></span>
                <?php endif; ?>

                <br>

                <select name="color">
                    <option value="">-- elige --</option>
                    <?php foreach (Punto::COLORES as $i => $elem): ?>
                        <option value="<?= $i ?>" <?= $valores["color"] === $i ? "selected" : "" ?>>
                            <?= $elem["nombre"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errores["color"])): ?>
                    <span class="error"><?= $errores["color"] ?></span>
                <?php endif; ?>

                <br>

                <?php foreach (Punto::GROSORES as $i => $elem): ?>
                    <label>
                        <input type="radio" name="grosor" value="<?= $i ?>"
                            <?= $valores["grosor"] == $i ? "checked" : "" ?>>
                        <?= $elem ?>
                    </label>
                <?php endforeach; ?>
                <?php if (isset($errores["grosor"])): ?>
                    <span class="error"><?= $errores["grosor"] ?></span>
                <?php endif; ?>

                <br>
                <button type="submit" name="guardar">Guardar</button>
            </fieldset>
        </form>
    </main>
<?php
}
