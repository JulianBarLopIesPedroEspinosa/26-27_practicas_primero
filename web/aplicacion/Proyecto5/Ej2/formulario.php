<?php

use function VALFILTER\validaCadena;
use function VALFILTER\validaEntero;
use function VALFILTER\validaExpresion;
use function VALFILTER\validaFecha;
use function VALFILTER\validaHora;
use function VALFILTER\validaRango;
use function VALFILTER\validaReal;

include_once(dirname(__FILE__) . "/../../../cabecera.php");

// Librería de validación reutilizable (la de FILTER, sin espacio de nombres)
include_once(RUTABASE . "/scripts/libreriasPr5/val_filter.php");


// =====================================================================
// CONSTANTES: opciones válidas de los radiobuttons y de los checkbox.
// Las uso tanto en el controlador (para validar) como en la vista (para
// dibujar el formulario y el resumen). La clave es el código que se envía.
// Las opciones incorrectas (5 y 6) NO están aquí: solo se añaden en el
// formulario para poder probar que la validación las rechaza.
// =====================================================================
const ESTADOS = [
    1 => "Estudiante",
    2 => "En paro",
    3 => "Trabajando",
    4 => "Jubilado"
];

const ESTUDIOS = [
    0 => "Sin estudios",
    1 => "Primaria",
    2 => "Secundaria",
    3 => "Bachillerato",
    4 => "Ciclo formativo",
    5 => "Universitarios"
];


// =====================================================================
// CONTROLADOR
// =====================================================================
$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Proyecto5"
    ],
    [
        "TEXTO" => "Ejercicio 2",
        "ENLACE" => "/aplicacion/Proyecto5/Ej2/index.php"
    ]
];

// Valores iniciales: son los que se ven la primera vez que se abre la página
$datos = [
    "nombre" => "",
    "contrasena" => "",
    "nacimiento" => "",
    "carnetDia" => "",
    "carnetMes" => "",
    "carnetAnio" => "",
    "hora" => "",
    "estado" => "",       // ningún radiobutton marcado al principio
    "estudios" => [],     // ningún checkbox marcado al principio
    "hermanos" => 0,
    "sueldo" => 1100.0
];

// Mensajes de error de cada campo. Si al final está vacío, todo es correcto.
$errores = [];

// ¿Se ha pulsado el botón de enviar? La primera vez que se abre la página, no.
$enviado = isset($_POST["enviar"]);

if ($enviado) {

    // ---------- NOMBRE ----------
    // Máximo 25 caracteres, no vacío, no empieza por H. Se pasa a mayúsculas.
    // Uso elseif para que, si falla una comprobación, no se hagan las siguientes
    // (si no, se acumularían varios errores para el mismo campo).
    $nombre = trim($_POST["nombre"] ?? "");

    if ($nombre === "") {
        $errores["nombre"] = "El nombre no puede estar vacío.";
    } elseif (!validaCadena($nombre, 25, "")) {
        $errores["nombre"] = "El nombre no puede tener más de 25 caracteres.";
    } elseif (!validaExpresion($nombre, '/^[^Hh]/u', "")) {
        $errores["nombre"] = "El nombre no puede empezar por H.";
    } else {
        $nombre = mb_strtoupper($nombre);
    }
    $datos["nombre"] = $nombre;


 
    $contrasena = $_POST["contrasena"] ?? "";
    $expContrasena = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[$_\-;<>@])[A-Za-z\d$_\-;<>@]{8,}$/';

    // Ojo: el mensaje va con comillas simples. Con dobles, PHP leería "$_" como una variable.
    if ($contrasena === "") {
        $errores["contrasena"] = "La contraseña no puede estar vacía.";
    } elseif (!validaCadena($contrasena, 15, "")) {
        $errores["contrasena"] = "La contraseña no puede tener más de 15 caracteres.";
    } elseif (!validaExpresion($contrasena, $expContrasena, "")) {
        $errores["contrasena"] = 'Mínimo 8 caracteres, con mayúscula, minúscula, cifra y un carácter especial ($_-;<>@).';
    }
    $datos["contrasena"] = $contrasena;


    // ---------- FECHA DE NACIMIENTO ----------
    // Una sola cadena dd/mm/aaaa. validaFecha la deja saneada (1/2/2000 → 01/02/2000).
    $nacimiento = trim($_POST["nacimiento"] ?? "");

    if (!validaFecha($nacimiento, "")) {
        $errores["nacimiento"] = "Fecha de nacimiento no válida (dd/mm/aaaa).";
    }
    $datos["nacimiento"] = $nacimiento;


    // ---------- FECHA DE CARNET ----------
    // Llegan tres campos separados: los junto en una fecha y la valido.
    $carnet = trim($_POST["carnetDia"] ?? "") . "/" .
              trim($_POST["carnetMes"] ?? "") . "/" .
              trim($_POST["carnetAnio"] ?? "");

    if (!validaFecha($carnet, "")) {
        $errores["carnet"] = "Fecha de carnet no válida.";
    } elseif (!isset($errores["nacimiento"])) {
        // Solo si las dos fechas son válidas compruebo la mayoría de edad:
        // a la fecha del carnet le resto 18 años (sub). Si el resultado es
        // anterior al nacimiento, cuando se sacó el carnet no tenía 18 años.
        $fechaNacimiento = DateTime::createFromFormat("!d/m/Y", $nacimiento);
        $fechaLimite = DateTime::createFromFormat("!d/m/Y", $carnet);
        $fechaLimite->sub(new DateInterval("P18Y"));

        // diff devuelve un DateInterval. invert vale 1 si $fechaLimite
        // es anterior a $fechaNacimiento (la diferencia es "negativa").
        $intervalo = $fechaNacimiento->diff($fechaLimite);
        if ($intervalo->invert == 1) {
            $errores["carnet"] = "Tenía que ser mayor de edad al sacarse el carnet.";
        }
    }

    // Para volver a mostrar el formulario separo la fecha (ya saneada) en sus tres partes
    if ($carnet === "") {
        $datos["carnetDia"] = "";
        $datos["carnetMes"] = "";
        $datos["carnetAnio"] = "";
    } else {
        $partes = explode("/", $carnet);
        $datos["carnetDia"] = $partes[0];
        $datos["carnetMes"] = $partes[1];
        $datos["carnetAnio"] = $partes[2];
    }


    // ---------- HORA DE LEVANTARSE ----------
    $hora = trim($_POST["hora"] ?? "");

    if (!validaHora($hora, "")) {
        $errores["hora"] = "Hora no válida (hh:mm:ss).";
    }
    $datos["hora"] = $hora;


    // ---------- ESTADO (radiobuttons) ----------
    // Si no se marca ninguno, el campo NO llega en $_POST.
    // Lo que llega es el código: tiene que ser una de las claves de ESTADOS.
    $estado = $_POST["estado"] ?? "";

    if ($estado === "") {
        $errores["estado"] = "Debe seleccionar un estado.";
    } elseif (!validaRango($estado, ESTADOS, 2)) {
        $errores["estado"] = "El estado seleccionado no es válido.";
        $estado = "";     // corrijo: lo dejo sin marcar
    }
    $datos["estado"] = $estado;


    // ---------- ESTUDIOS (checkbox) ----------
    // Llegan como array (name="estudios[]"). Si no se marca ninguno, no llega.
    $marcados = $_POST["estudios"] ?? [];
    $estudios = [];      // aquí guardo solo los códigos válidos

    if (!is_array($marcados) || count($marcados) == 0) {
        $errores["estudios"] = "Debe seleccionar al menos una opción.";
    } else {
        foreach ($marcados as $codigo) {
            if (validaRango($codigo, ESTUDIOS, 2)) {
                $estudios[] = (int) $codigo;
            } else {
                $errores["estudios"] = "Hay alguna opción de estudios no válida.";
            }
        }

        // Si ha marcado "Sin estudios" (0), desmarco el resto
        if (in_array(0, $estudios)) {
            $estudios = [0];
        }

        // Si todas las marcadas eran incorrectas, no queda ninguna
        if (count($estudios) == 0 && !isset($errores["estudios"])) {
            $errores["estudios"] = "Debe seleccionar al menos una opción.";
        }
    }
    $datos["estudios"] = $estudios;


    // ---------- HERMANOS ----------
    // Entero entre 0 y 20. Si se deja vacío, se queda el valor por defecto (0).
    // Antes de convertirlo con (int) compruebo que es un entero, porque
    // (int) "abc" da 0 sin avisar y (int) "2.5" da 2.
    $textoHermanos = trim($_POST["hermanos"] ?? "");
    $hermanos = 0;

    if ($textoHermanos !== "") {
        if (!validaExpresion($textoHermanos, '/^-?\d+$/', "")) {
            $errores["hermanos"] = "Hermanos debe ser un número entero.";
        } else {
            $hermanos = (int) $textoHermanos;
            if (!validaEntero($hermanos, 0, 20, 0)) {
                $errores["hermanos"] = "Hermanos debe estar entre 0 y 20.";
            }
        }
    }
    $datos["hermanos"] = $hermanos;


    // ---------- SUELDO ----------
    // Real entre 1000 y 150000. Si se deja vacío, se queda el valor por defecto (1100).
    // Admito la coma decimal española cambiándola por un punto.
    $textoSueldo = str_replace(",", ".", trim($_POST["sueldo"] ?? ""));
    $sueldo = 1100.0;

    if ($textoSueldo !== "") {
        if (!is_numeric($textoSueldo)) {
            $errores["sueldo"] = "El sueldo debe ser un número.";
        } else {
            $sueldo = (float) $textoSueldo;
            if (!validaReal($sueldo, 1000, 150000, 1100)) {
                $errores["sueldo"] = "El sueldo debe estar entre 1000 y 150000 €.";
            }
        }
    }
    $datos["sueldo"] = $sueldo;
}

// Se muestra el formulario la primera vez, o si hay algún error.
// Si se ha enviado y no hay errores, se muestra el resumen.
$mostrarFormulario = !$enviado || count($errores) > 0;


//dibuja la plantilla de la vista
inicioCabecera("Relación 5 - Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Relación 5 - Ejercicio 2", $barra);
cuerpo($datos, $errores, $mostrarFormulario);  //llamo a la vista
finCuerpo();
// **********************************************************


// =====================================================================
// VISTA
// =====================================================================

function cabecera()
{
?>
    <!-- esto va en el head -->
    <style>
        .campo {
            margin-bottom: 14px;
        }

        .campo > label {
            display: block;
            margin-bottom: 2px;
        }

        .campo .error {
            margin: 4px 0 0;
            padding: 6px 12px;
        }

        .opciones label {
            font-weight: 400;
            margin-right: 16px;
        }

        .carnet input {
            width: 80px;
        }
    </style>
<?php
}

//vista
function cuerpo(array $datos, array $errores, bool $mostrarFormulario)
{
?>
    <main id="main">
        <h2>2.- Formulario de datos personales</h2>

        <?php
        if ($mostrarFormulario) {
            formulario($datos, $errores);
        } else {
            resumen($datos);
        }
        ?>
    </main>
<?php
}

/**
 * Muestra el mensaje de error de un campo, si lo tiene.
 */
function mostrarError(array $errores, string $campo): void
{
    if (isset($errores[$campo])) {
        echo '<div class="error">' . htmlspecialchars($errores[$campo]) . '</div>';
    }
}

/**
 * Dibuja el formulario.
 * $datos: valores que se muestran en cada campo.
 * $errores: mensaje de error de cada campo (si lo tiene).
 * Todos los valores se escapan con htmlspecialchars para que lo que escriba
 * el usuario no se interprete como HTML.
 */
function formulario(array $datos, array $errores): void
{
    // Opciones que se muestran: las válidas más una incorrecta para probar
    $opcionesEstado = ESTADOS + [5 => "Incorrecta"];
    $opcionesEstudios = ESTUDIOS + [6 => "Incorrecta"];
?>
    <?php if (count($errores) > 0) { ?>
        <div class="error">Hay errores en el formulario. Revisa los campos marcados.</div>
    <?php } ?>

    <form method="post" action="">

        <fieldset>
            <legend>Datos personales</legend>

            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" size="30"
                    value="<?= htmlspecialchars($datos["nombre"]) ?>">
                <?php mostrarError($errores, "nombre"); ?>
            </div>

            <div class="campo">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" size="20"
                    value="<?= htmlspecialchars($datos["contrasena"]) ?>">
                <?php mostrarError($errores, "contrasena"); ?>
            </div>

            <div class="campo">
                <label for="nacimiento">Fecha de nacimiento (dd/mm/aaaa)</label>
                <input type="text" id="nacimiento" name="nacimiento" size="12"
                    value="<?= htmlspecialchars($datos["nacimiento"]) ?>">
                <?php mostrarError($errores, "nacimiento"); ?>
            </div>

            <div class="campo carnet">
                <label for="carnetDia">Fecha de carnet (día / mes / año)</label>
                <input type="text" id="carnetDia" name="carnetDia" placeholder="dd"
                    value="<?= htmlspecialchars($datos["carnetDia"]) ?>"> /
                <input type="text" name="carnetMes" placeholder="mm"
                    value="<?= htmlspecialchars($datos["carnetMes"]) ?>"> /
                <input type="text" name="carnetAnio" placeholder="aaaa"
                    value="<?= htmlspecialchars($datos["carnetAnio"]) ?>">
                <?php mostrarError($errores, "carnet"); ?>
            </div>

            <div class="campo">
                <label for="hora">Hora a la que se levanta (hh:mm:ss)</label>
                <input type="text" id="hora" name="hora" size="10"
                    value="<?= htmlspecialchars($datos["hora"]) ?>">
                <?php mostrarError($errores, "hora"); ?>
            </div>
        </fieldset>

        <fieldset>
            <legend>Situación</legend>

            <div class="campo opciones">
                <label>Estado</label>
                <?php
                // Un radiobutton por opción. Sale marcado el que coincide con $datos["estado"]
                foreach ($opcionesEstado as $codigo => $texto) {
                    $marcado = ($datos["estado"] !== "" && $datos["estado"] == $codigo) ? "checked" : "";
                    echo "<label><input type='radio' name='estado' value='$codigo' $marcado> $codigo - $texto</label>";
                }
                mostrarError($errores, "estado");
                ?>
            </div>

            <div class="campo opciones">
                <label>Estudios</label>
                <?php
                // Un checkbox por opción. name="estudios[]" hace que lleguen todos en un array
                foreach ($opcionesEstudios as $codigo => $texto) {
                    $marcado = in_array($codigo, $datos["estudios"]) ? "checked" : "";
                    echo "<label><input type='checkbox' name='estudios[]' value='$codigo' $marcado> $codigo - $texto</label>";
                }
                mostrarError($errores, "estudios");
                ?>
            </div>

            <div class="campo">
                <label for="hermanos">Número de hermanos (0 a 20)</label>
                <input type="text" id="hermanos" name="hermanos" size="5"
                    value="<?= htmlspecialchars((string) $datos["hermanos"]) ?>">
                <?php mostrarError($errores, "hermanos"); ?>
            </div>

            <div class="campo">
                <label for="sueldo">Sueldo en € (1000 a 150000)</label>
                <input type="text" id="sueldo" name="sueldo" size="12"
                    value="<?= htmlspecialchars((string) $datos["sueldo"]) ?>">
                <?php mostrarError($errores, "sueldo"); ?>
            </div>
        </fieldset>

        <input type="submit" name="enviar" value="Enviar">
    </form>
<?php
}

/**
 * Muestra el resumen con los datos introducidos (cuando todo es correcto).
 * El estado y los estudios se muestran con su texto, no con el código.
 */
function resumen(array $datos): void
{
    // Paso los códigos de estudios a sus textos
    $textosEstudios = [];
    foreach ($datos["estudios"] as $codigo) {
        $textosEstudios[] = ESTUDIOS[$codigo];
    }

    $carnet = $datos["carnetDia"] . "/" . $datos["carnetMes"] . "/" . $datos["carnetAnio"];
?>
    <div class="ok">Todos los datos son correctos.</div>

    <table>
        <tr>
            <th>Campo</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?= htmlspecialchars($datos["nombre"]) ?></td>
        </tr>
        <tr>
            <td>Contraseña</td>
            <td><?= str_repeat("*", mb_strlen($datos["contrasena"])) ?></td>
        </tr>
        <tr>
            <td>Fecha de nacimiento</td>
            <td><?= htmlspecialchars($datos["nacimiento"]) ?></td>
        </tr>
        <tr>
            <td>Fecha de carnet</td>
            <td><?= htmlspecialchars($carnet) ?></td>
        </tr>
        <tr>
            <td>Hora de levantarse</td>
            <td><?= htmlspecialchars($datos["hora"]) ?></td>
        </tr>
        <tr>
            <td>Estado</td>
            <td><?= ESTADOS[$datos["estado"]] ?></td>
        </tr>
        <tr>
            <td>Estudios</td>
            <td><?= implode(", ", $textosEstudios) ?></td>
        </tr>
        <tr>
            <td>Hermanos</td>
            <td><?= $datos["hermanos"] ?></td>
        </tr>
        <tr>
            <td>Sueldo</td>
            <td><?= number_format($datos["sueldo"], 2, ",", ".") ?> €</td>
        </tr>
    </table>

    <a href="index.php">Volver a rellenar el formulario</a>
<?php
}