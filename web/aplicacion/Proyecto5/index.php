<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Librerías de validación (son funciones, no clases: el autoload no las carga)
include_once(RUTABASE . "/scripts/libreriasPr5/val_normal.php");
include_once(RUTABASE . "/scripts/libreriasPr5/val_filter.php");

//Controlador
$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Proyecto5",
        "ENLACE" => "/aplicacion/Proyecto5/index.php"
    ]
];

// En $pruebas guardo, por cada función, su descripción y los casos probados.
// Cada caso es: [entrada, resultado VALNORMAL, $var VALNORMAL, resultado VALFILTER, $var VALFILTER]
// Se usa una copia de la entrada para cada librería, porque las funciones modifican $var.
$pruebas = [];

// ---------- validaEntero ----------
$pruebas["validaEntero"] = [
    "llamada" => "validaEntero(\$var, 0, 20, 0)",
    "descripcion" => "Entero entre 0 y 20 (los límites entran). Valor por defecto: 0.",
    "casos" => []
];
foreach ([15, 0, 20, 25, -1] as $entrada) {
    $varN = $entrada;
    $okN = \VALNORMAL\validaEntero($varN, 0, 20, 0);
    $varF = $entrada;
    $okF = \VALFILTER\validaEntero($varF, 0, 20, 0);
    $pruebas["validaEntero"]["casos"][] = [$entrada, $okN, $varN, $okF, $varF];
}

// ---------- validaReal ----------
$pruebas["validaReal"] = [
    "llamada" => "validaReal(\$var, 1000, 150000, 1100)",
    "descripcion" => "Real entre 1000 y 150000 (los límites entran). Valor por defecto: 1100.",
    "casos" => []
];
foreach ([1100.5, 1000.0, 150000.0, 999.99, 150000.01] as $entrada) {
    $varN = $entrada;
    $okN = \VALNORMAL\validaReal($varN, 1000, 150000, 1100);
    $varF = $entrada;
    $okF = \VALFILTER\validaReal($varF, 1000, 150000, 1100);
    $pruebas["validaReal"]["casos"][] = [$entrada, $okN, $varN, $okF, $varF];
}

// ---------- validaFecha ----------
$pruebas["validaFecha"] = [
    "llamada" => "validaFecha(\$var, \"01/01/2000\")",
    "descripcion" => "Fecha dd/mm/aaaa que exista. Se sanea a 2 cifras para día y mes.",
    "casos" => []
];
foreach (["1/2/2023", "29/02/2024", "29/02/2023", "31/02/2023", "13/13/2023", "1/2/3"] as $entrada) {
    $varN = $entrada;
    $okN = \VALNORMAL\validaFecha($varN, "01/01/2000");
    $varF = $entrada;
    $okF = \VALFILTER\validaFecha($varF, "01/01/2000");
    $pruebas["validaFecha"]["casos"][] = [$entrada, $okN, $varN, $okF, $varF];
}

// ---------- validaHora ----------
$pruebas["validaHora"] = [
    "llamada" => "validaHora(\$var, \"07:00:00\")",
    "descripcion" => "Hora hh:mm:ss válida. Se sanea a 2 cifras cada parte.",
    "casos" => []
];
foreach (["0:5:1", "07:05:09", "23:59:59", "24:00:00", "12:60:00", "7:30"] as $entrada) {
    $varN = $entrada;
    $okN = \VALNORMAL\validaHora($varN, "07:00:00");
    $varF = $entrada;
    $okF = \VALFILTER\validaHora($varF, "07:00:00");
    $pruebas["validaHora"]["casos"][] = [$entrada, $okN, $varN, $okF, $varF];
}

// ---------- validaEmail ----------
$pruebas["validaEmail"] = [
    "llamada" => "validaEmail(\$var, \"nadie@correo.com\")",
    "descripcion" => "Email con formato aaaaa@bbbb.ccc. Se ignoran los espacios de los extremos.",
    "casos" => []
];
foreach (["pepe@gmail.com", " pepe@gmail.com ", "ana.lopez@correo.iesx.es", "pe(pe@gmail.com", "pe pe@gmail.com", "pepe@", "pepe.gmail.com"] as $entrada) {
    $varN = $entrada;
    $okN = \VALNORMAL\validaEmail($varN, "nadie@correo.com");
    $varF = $entrada;
    $okF = \VALFILTER\validaEmail($varF, "nadie@correo.com");
    $pruebas["validaEmail"]["casos"][] = [$entrada, $okN, $varN, $okF, $varF];
}

// ---------- validaCadena ----------
$pruebas["validaCadena"] = [
    "llamada" => "validaCadena(\$var, 4, \"def\")",
    "descripcion" => "Cadena de 4 caracteres como máximo (la ñ cuenta como 1).",
    "casos" => []
];
foreach (["Ñoño", "Ñoños", "", "abc"] as $entrada) {
    $varN = $entrada;
    $okN = \VALNORMAL\validaCadena($varN, 4, "def");
    $varF = $entrada;
    $okF = \VALFILTER\validaCadena($varF, 4, "def");
    $pruebas["validaCadena"]["casos"][] = [$entrada, $okN, $varN, $okF, $varF];
}

// ---------- validaExpresion ----------
$expresion = '/^[^Hh]/u';
$pruebas["validaExpresion"] = [
    "llamada" => "validaExpresion(\$var, '$expresion', \"def\")",
    "descripcion" => "Cumple la expresión regular: no empieza por H ni h.",
    "casos" => []
];
foreach (["Pedro", "Ángel", "Hugo", "hugo"] as $entrada) {
    $varN = $entrada;
    $okN = \VALNORMAL\validaExpresion($varN, $expresion, "def");
    $varF = $entrada;
    $okF = \VALFILTER\validaExpresion($varF, $expresion, "def");
    $pruebas["validaExpresion"]["casos"][] = [$entrada, $okN, $varN, $okF, $varF];
}

// ---------- validaRango ----------
// No modifica $var (no va por referencia): en las columnas de $var sale igual que la entrada.
// El tipo usado lo guardo como sexto elemento del caso para mostrarlo junto a la entrada.
$estados = [1 => "estudiante", 2 => "en paro", 3 => "trabajando", 4 => "jubilado"];
$pruebas["validaRango"] = [
    "llamada" => "validaRango(\$var, \$estados, \$tipo)",
    "descripcion" => "\$estados = [1 => \"estudiante\", 2 => \"en paro\", 3 => \"trabajando\", 4 => \"jubilado\"]. "
        . "Tipo 1: busca en los valores. Tipo 2: busca en las claves.",
    "casos" => []
];
$casosRango = [
    ["jubilado", 1],
    ["parado", 1],
    [3, 2],
    ["3", 2],
    [5, 2],
    [3, 3],
];
foreach ($casosRango as $caso) {
    $entrada = $caso[0];
    $tipo = $caso[1];
    $okN = \VALNORMAL\validaRango($entrada, $estados, $tipo);
    $okF = \VALFILTER\validaRango($entrada, $estados, $tipo);
    $pruebas["validaRango"]["casos"][] = [$entrada, $okN, $entrada, $okF, $entrada, "tipo $tipo"];
}


//dibuja la plantilla de la vista
inicioCabecera("Relación 5");
cabecera();
finCabecera();
inicioCuerpo("Relación 5", $barra);
cuerpo($pruebas);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>
    <!-- esto va en el head -->
    <style>
        #main table th {
            white-space: nowrap;
        }

        .correcto {
            color: var(--exito);
            font-weight: 600;
        }

        .incorrecto {
            color: var(--error);
            font-weight: 600;
        }
    </style>
<?php
}

/**
 * Devuelve un valor preparado para mostrarlo en la página:
 * las cadenas entre comillas (así se ven los espacios) y escapado para HTML.
 */
function mostrarValor(mixed $valor): string
{
    if (is_string($valor)) {
        $valor = '"' . $valor . '"';
    }
    return htmlspecialchars((string) $valor);
}

/**
 * Devuelve el true/false coloreado en verde o rojo.
 */
function mostrarResultado(bool $ok): string
{
    if ($ok) {
        return '<span class="correcto">true</span>';
    }
    return '<span class="incorrecto">false</span>';
}

//vista
function cuerpo(array $pruebas)
{
?>
    <main id="main">

        <h2>1.- Librerías de validación</h2>
        <p class="enunciado">Se prueban las librerías val_normal.php (espacio de nombres VALNORMAL,
            con comparaciones y expresiones regulares) y val_filter.php (espacio de nombres VALFILTER,
            con la librería FILTER). Cada función se llama en las dos librerías con los mismos valores,
            y se muestra lo que devuelve y cómo queda $var (saneado o con el valor por defecto).</p>

        <?php
        foreach ($pruebas as $funcion => $prueba) {
        ?>
            <h3><?= $funcion ?></h3>
            <p><code><?= htmlspecialchars($prueba["llamada"]) ?></code> &nbsp; <?= htmlspecialchars($prueba["descripcion"]) ?></p>

            <table>
                <tr>
                    <th>Entrada</th>
                    <th>VALNORMAL</th>
                    <th>$var VALNORMAL</th>
                    <th>VALFILTER</th>
                    <th>$var VALFILTER</th>
                </tr>
                <?php
                foreach ($prueba["casos"] as $caso) {
                ?>
                    <tr>
                        <td>
                            <?= mostrarValor($caso[0]) ?>
                            <?php if (isset($caso[5])) echo " &nbsp;(" . $caso[5] . ")"; ?>
                        </td>
                        <td><?= mostrarResultado($caso[1]) ?></td>
                        <td><?= mostrarValor($caso[2]) ?></td>
                        <td><?= mostrarResultado($caso[3]) ?></td>
                        <td><?= mostrarValor($caso[4]) ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        <?php
        }
        ?>

    </main>
<?php
}