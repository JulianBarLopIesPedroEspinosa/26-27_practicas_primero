<?php

/**
 * Relacion 5 - Ejercicio 2: formulario de datos personales.
 *
 * Funcionamiento:
 *  - La primera vez se muestra el formulario con los valores iniciales.
 *  - Al enviarlo (por post, al propio fichero) el controlador valida cada
 *    campo con la libreria de validacion.
 *  - Si hay algun error, se vuelve a mostrar el formulario con los datos
 *    validados y corregidos y el mensaje de error de cada campo.
 *  - Si todo es correcto, no se muestra el formulario sino un resumen.
 */

// Funciones de validacion que se usan, importadas del espacio de nombres
// VALFILTER para poder llamarlas sin el prefijo (validaFecha en lugar de
// \VALFILTER\validaFecha)
use function VALFILTER\validaCadena;
use function VALFILTER\validaEntero;
use function VALFILTER\validaExpresion;
use function VALFILTER\validaFecha;
use function VALFILTER\validaHora;
use function VALFILTER\validaRango;
use function VALFILTER\validaReal;

include_once(dirname(__FILE__) . "/../../../cabecera.php");

// Libreria de validacion con FILTER. Son funciones, no clases, asi que el
// autoload no la carga: hay que incluirla a mano
include_once(RUTABASE . "/scripts/libreriasPr5/val_filter.php");


// =====================================================================
// CONSTANTES: opciones validas de los radiobuttons y de los checkbox.
// Se usan en el controlador (para validar) y en la vista (para dibujar
// el formulario y el resumen). La clave es el codigo que se envia.
// Las opciones incorrectas (5 y 6) NO estan aqui: solo se agregan en el
// formulario para poder probar que la validacion las rechaza.
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

// Barra de ubicacion: Inicio >> Proyecto5 >> Ejercicio 2
$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Proyecto5",
        "ENLACE" => "/aplicacion/Proyecto5/index.php"
    ],
    [
        "TEXTO" => "Ejercicio 2"
    ]
];

// Valores iniciales: son los que se ven la primera vez que se abre la pagina.
// Si se envia el formulario, cada campo se sustituye por su valor validado.
$datos = [
    "nombre" => "",
    "contrasena" => "",
    "nacimiento" => "",
    "carnetDia" => "",
    "carnetMes" => "",
    "carnetAnio" => "",
    "hora" => "",
    "estado" => "",       // ningun radiobutton marcado al principio
    "estudios" => [],     // ningun checkbox marcado al principio
    "hermanos" => 0,      // valor por defecto que pide el enunciado
    "sueldo" => 1100.0    // valor por defecto que pide el enunciado
];

// Mensajes de error de cada campo (la clave es el nombre del campo).
// Si al final esta vacio, todo es correcto.
$errores = [];

// El formulario se ha enviado si llega el boton "enviar".
// La primera vez que se abre la pagina no llega.
$enviado = isset($_POST["enviar"]);

if ($enviado) {

    // ---------- NOMBRE ----------
    // Maximo 25 caracteres, no vacio, no empieza por H. Se pasa a mayusculas.
    // Se usa elseif para que, si falla una comprobacion, no se hagan las
    // siguientes (si no, se acumularian varios errores para el mismo campo).
    // ?? "" evita el aviso de PHP si el campo no llega en $_POST.
    $nombre = trim($_POST["nombre"] ?? "");

    if ($nombre === "") {
        $errores["nombre"] = "El nombre no puede estar vacio.";
    } elseif (!validaCadena($nombre, 25, "")) {
        $errores["nombre"] = "El nombre no puede tener mas de 25 caracteres.";
    } elseif (!validaExpresion($nombre, '/^[^Hh]/u', "")) {
        $errores["nombre"] = "El nombre no puede empezar por H.";
    } else {
        $nombre = mb_strtoupper($nombre);
    }
    $datos["nombre"] = $nombre;


    // ---------- CONTRASEÑA ----------
    // Maximo 15 caracteres (validaCadena) y la expresion regular comprueba:
    //   ^                  principio de la cadena
    //   (?=.*[A-Z])        mas adelante hay al menos una mayuscula
    //   (?=.*[a-z])        mas adelante hay al menos una minuscula
    //   (?=.*\d)           mas adelante hay al menos una cifra
    //   (?=.*[$_\-;<>@])   mas adelante hay al menos un caracter especial de la lista
    //   [A-Za-zñÑ\d$_\-;<>@]{8,}
    //                      la contraseña completa: solo esos caracteres y minimo 8.
    //                      La ñ es una modificacion propia: la expresion
    //                      original no la permitia
    //   $                  final de la cadena
    //   u                  modo UTF-8: la ñ cuenta como 1 caracter y no como 2 bytes
    // Los (?=...) son lookahead: comprueban sin "consumir" caracteres, por eso
    // se pueden poner varios seguidos y todos miran la contraseña entera.
    $contrasena = $_POST["contrasena"] ?? "";
    $expContrasena = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[$_\-;<>@])[A-Za-zñÑ\d$_\-;<>@]{8,}$/u';

    // El ultimo mensaje va con comillas simples: con dobles, PHP leeria "$_" como una variable
    if ($contrasena === "") {
        $errores["contrasena"] = "La contraseña no puede estar vacia.";
    } elseif (!validaCadena($contrasena, 15, "")) {
        $errores["contrasena"] = "La contraseña no puede tener mas de 15 caracteres.";
    } elseif (!validaExpresion($contrasena, $expContrasena, "")) {
        $errores["contrasena"] = 'Minimo 8 caracteres, con mayuscula, minuscula, cifra y un caracter especial ($_-;<>@).';
    }
    $datos["contrasena"] = $contrasena;


    // ---------- FECHA DE NACIMIENTO ----------
    // Una sola cadena dd/mm/aaaa. validaFecha la deja saneada (1/2/2000 -> 01/02/2000).
    $nacimiento = trim($_POST["nacimiento"] ?? "");

    if (!validaFecha($nacimiento, "")) {
        $errores["nacimiento"] = "Fecha de nacimiento no valida (dd/mm/aaaa).";
    }
    $datos["nacimiento"] = $nacimiento;


    // ---------- FECHA DE CARNET ----------
    // Llegan tres campos separados: se juntan en una fecha y se valida.
    $carnet = trim($_POST["carnetDia"] ?? "") . "/" .
              trim($_POST["carnetMes"] ?? "") . "/" .
              trim($_POST["carnetAnio"] ?? "");

    if (!validaFecha($carnet, "")) {
        $errores["carnet"] = "Fecha de carnet no valida.";
    } elseif (!isset($errores["nacimiento"])) {

        // Solo si las dos fechas son validas se comprueba la mayoria de edad:
        // a la fecha del carnet se le restan 18 años (sub). Si el resultado es
        // anterior al nacimiento, cuando se saco el carnet no tenia 18 años.
        // El ! del formato pone la hora a 00:00:00 (si no, coge la hora actual).
        $fechaNacimiento = DateTime::createFromFormat("!d/m/Y", $nacimiento);
        $fechaLimite = DateTime::createFromFormat("!d/m/Y", $carnet);
        $fechaLimite->sub(new DateInterval("P18Y"));

        // diff devuelve un DateInterval. invert vale 1 si $fechaLimite
        // es anterior a $fechaNacimiento (la diferencia es "negativa").
        $intervalo = $fechaNacimiento->diff($fechaLimite);
        if ($intervalo->invert == 1) {
            $errores["carnet"] = "Tenia que ser mayor de edad al sacarse el carnet.";
        }
    }

    // Para volver a mostrar el formulario, la fecha (ya saneada) se separa
    // otra vez en sus tres partes. Si no era valida, queda vacia.
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
    // Cadena hh:mm:ss. validaHora la deja saneada (7:5:0 -> 07:05:00).
    $hora = trim($_POST["hora"] ?? "");

    if (!validaHora($hora, "")) {
        $errores["hora"] = "Hora no valida (hh:mm:ss).";
    }
    $datos["hora"] = $hora;


    // ---------- ESTADO (radiobuttons) ----------
    // Si no se marca ninguno, el campo NO llega en $_POST.
    // Lo que llega es el codigo: tiene que ser una de las claves de ESTADOS
    // (validaRango con tipo 2 busca en las claves).
    $estado = $_POST["estado"] ?? "";

    if ($estado === "") {
        $errores["estado"] = "Debe seleccionar un estado.";
    } elseif (!validaRango($estado, ESTADOS, 2)) {
        $errores["estado"] = "El estado seleccionado no es valido.";
        $estado = "";     // se corrige: queda sin marcar
    }
    $datos["estado"] = $estado;


    // ---------- ESTUDIOS (checkbox) ----------
    // Llegan como array (name="estudios[]"). Si no se marca ninguno, no llega.
    $marcados = $_POST["estudios"] ?? [];
    $estudios = [];      // aqui se guardan solo los codigos validos

    if (!is_array($marcados) || count($marcados) == 0) {
        $errores["estudios"] = "Debe seleccionar al menos una opcion.";
    } else {
        // Se valida cada codigo marcado. Los incorrectos se descartan.
        foreach ($marcados as $codigo) {
            if (validaRango($codigo, ESTUDIOS, 2)) {
                $estudios[] = (int) $codigo;
            } else {
                $errores["estudios"] = "Hay alguna opcion de estudios no valida.";
            }
        }

        // Si ha marcado "Sin estudios" (0), se desmarca el resto
        if (in_array(0, $estudios)) {
            $estudios = [0];
        }

        // Si todas las marcadas eran incorrectas, no queda ninguna
        if (count($estudios) == 0 && !isset($errores["estudios"])) {
            $errores["estudios"] = "Debe seleccionar al menos una opcion.";
        }
    }
    $datos["estudios"] = $estudios;


    // ---------- HERMANOS ----------
    // Entero entre 0 y 20. Si se deja vacio, se queda el valor por defecto (0).
    // Antes de convertirlo con (int) se comprueba que es un entero, porque
    // (int) "abc" da 0 sin avisar y (int) "2.5" da 2.
    $textoHermanos = trim($_POST["hermanos"] ?? "");
    $hermanos = 0;

    if ($textoHermanos !== "") {
        if (!validaExpresion($textoHermanos, '/^-?\d+$/', "")) {
            $errores["hermanos"] = "Hermanos debe ser un numero entero.";
        } else {
            $hermanos = (int) $textoHermanos;
            if (!validaEntero($hermanos, 0, 20, 0)) {
                $errores["hermanos"] = "Hermanos debe estar entre 0 y 20.";
            }
        }
    }
    $datos["hermanos"] = $hermanos;


    // ---------- SUELDO ----------
    // Real entre 1000 y 150000. Si se deja vacio, se queda el valor por defecto (1100).
    // Se admite la coma decimal cambiandola por un punto antes de comprobarlo.
    $textoSueldo = str_replace(",", ".", trim($_POST["sueldo"] ?? ""));
    $sueldo = 1100.0;

    if ($textoSueldo !== "") {
        if (!is_numeric($textoSueldo)) {
            $errores["sueldo"] = "El sueldo debe ser un numero.";
        } else {
            $sueldo = (float) $textoSueldo;
            if (!validaReal($sueldo, 1000, 150000, 1100)) {
                $errores["sueldo"] = "El sueldo debe estar entre 1000 y 150000 €.";
            }
        }
    }
    $datos["sueldo"] = $sueldo;
}

// Se muestra el formulario la primera vez, o si hay algun error.
// Si se ha enviado y no hay errores, se muestra el resumen.
$mostrarFormulario = !$enviado || count($errores) > 0;


//dibuja la plantilla de la vista
inicioCabecera("Relacion 5 - Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Relacion 5 - Ejercicio 2", $barra);
cuerpo($datos, $errores, $mostrarFormulario);  //llamo a la vista
finCuerpo();
// **********************************************************


// =====================================================================
// VISTA
// =====================================================================

/**
 * Contenido extra del head. Esta pagina no necesita nada aparte
 * de base.css, pero la funcion la pide la plantilla.
 */
function cabecera()
{
}

/**
 * Cuerpo de la pagina: muestra el formulario o el resumen.
 *
 * @param array $datos Valores de los campos.
 * @param array $errores Mensajes de error de cada campo.
 * @param bool $mostrarFormulario true si hay que mostrar el formulario,
 *                                false si hay que mostrar el resumen.
 */
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
 * Se escapa con htmlspecialchars porque algun mensaje lleva < y >
 * (el de la contraseña) y se interpretarian como HTML.
 *
 * @param array $errores Mensajes de error de cada campo.
 * @param string $campo Nombre del campo.
 */
function mostrarError(array $errores, string $campo): void
{
    if (isset($errores[$campo])) {
        echo '<div class="error">' . htmlspecialchars($errores[$campo]) . '</div>';
    }
}

/**
 * Dibuja el formulario. Se envia por post al propio fichero.
 * Los valores de los campos se escapan con htmlspecialchars porque
 * vienen del usuario: asi no se interpretan como HTML.
 *
 * @param array $datos Valores que se muestran en cada campo.
 * @param array $errores Mensaje de error de cada campo (si lo tiene).
 */
function formulario(array $datos, array $errores): void
{
    // Opciones que se muestran: las validas mas una incorrecta para probar
    $opcionesEstado = ESTADOS + [5 => "Incorrecta"];
    $opcionesEstudios = ESTUDIOS + [6 => "Incorrecta"];
?>
    <?php
    // Aviso general si hay algun error
    if (count($errores) > 0) {
    ?>
        <div class="error">Hay errores en el formulario. Revisa los campos marcados.</div>
    <?php
    }
    ?>

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

            <!-- Fecha de carnet: tres campos independientes (dia, mes y año) -->
            <div class="campo carnet">
                <label for="carnetDia">Fecha de carnet (dia / mes / año)</label>
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
            <legend>Situacion</legend>

            <div class="campo opciones">
                <label>Estado</label>
                <?php
                // Un radiobutton por opcion. Sale marcado el que coincide con $datos["estado"]
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
                // Un checkbox por opcion. name="estudios[]" hace que lleguen todos en un array.
                // Salen marcados los codigos que estan en $datos["estudios"]
                foreach ($opcionesEstudios as $codigo => $texto) {
                    $marcado = in_array($codigo, $datos["estudios"]) ? "checked" : "";
                    echo "<label><input type='checkbox' name='estudios[]' value='$codigo' $marcado> $codigo - $texto</label>";
                }
                mostrarError($errores, "estudios");
                ?>
            </div>

            <div class="campo">
                <label for="hermanos">Numero de hermanos (0 a 20)</label>
                <!-- (string) porque htmlspecialchars solo acepta cadenas -->
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
 * El estado y los estudios se muestran con su texto, no con el codigo.
 * La contraseña no se muestra: se sustituye por asteriscos.
 *
 * @param array $datos Valores validados de todos los campos.
 */
function resumen(array $datos): void
{
    // Se pasan los codigos de estudios a sus textos
    $textosEstudios = [];
    foreach ($datos["estudios"] as $codigo) {
        $textosEstudios[] = ESTUDIOS[$codigo];
    }

    // Se vuelve a juntar la fecha de carnet en una sola cadena
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
            <!-- un asterisco por cada caracter de la contraseña -->
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
            <!-- formato español: 2 decimales, coma decimal y punto de miles -->
            <td><?= number_format($datos["sueldo"], 2, ",", ".") ?> €</td>
        </tr>
    </table>

    <a href="index.php">Volver a rellenar el formulario</a>
<?php
}