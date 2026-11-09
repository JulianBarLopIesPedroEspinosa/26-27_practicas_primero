<?php

/**
 * Relacion 5 - Ejercicio 1: pruebas de las librerias de validacion.
 *
 * Se comprueban las dos librerias creadas en el ejercicio:
 *  - val_normal.php (espacio de nombres VALNORMAL): valida con comparaciones
 *    y expresiones regulares.
 *  - val_filter.php (espacio de nombres VALFILTER): valida con la libreria FILTER.
 *
 * Cada funcion se llama en las dos librerias con los mismos valores de entrada,
 * y se muestra lo que devuelve (true/false) y como queda $var despues de la
 * llamada (saneado si es correcto o con el valor por defecto si no lo es).
 */

include_once(dirname(__FILE__) . "/../../../cabecera.php");

// Librerias de validacion. Son funciones, no clases, asi que el autoload
// no las carga: hay que incluirlas a mano
include_once(RUTABASE . "/scripts/libreriasPr5/val_normal.php");
include_once(RUTABASE . "/scripts/libreriasPr5/val_filter.php");


// =====================================================================
// CONTROLADOR
// =====================================================================

// Barra de ubicacion: Inicio >> Proyecto5 >> Ej1
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
        "TEXTO" => "Ej1"
    ]
];

// En $pruebas se guarda, por cada funcion:
//  - "llamada": como se llama a la funcion (se muestra en la pagina)
//  - "descripcion": que se comprueba
//  - "casos": los resultados de cada valor probado
//
// Cada caso es un array con este orden:
//  [0] entrada, [1] resultado VALNORMAL, [2] $var VALNORMAL,
//  [3] resultado VALFILTER, [4] $var VALFILTER, [5] nota opcional
//
// Se usa una copia de la entrada para cada libreria ($varN y $varF)
// porque las funciones reciben $var por referencia y la modifican.
$pruebas = [];


// ---------- validaEntero ----------
// Rango 0-20: se prueban valores dentro, los dos limites y valores fuera
$pruebas["validaEntero"] = [
    "llamada" => "validaEntero(\$var, 0, 20, 0)",
    "descripcion" => "Entero entre 0 y 20 (los limites entran). Valor por defecto: 0.",
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
// Rango 1000-150000 (el del sueldo del ejercicio 2)
$pruebas["validaReal"] = [
    "llamada" => "validaReal(\$var, 1000, 150000, 1100)",
    "descripcion" => "Real entre 1000 y 150000 (los limites entran). Valor por defecto: 1100.",
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
// Fecha sin ceros (se sanea), bisiesto valido, bisiesto no valido,
// dia que no existe, mes que no existe y anio con menos de 4 cifras
$pruebas["validaFecha"] = [
    "llamada" => "validaFecha(\$var, \"01/01/2000\")",
    "descripcion" => "Fecha dd/mm/aaaa que exista. Se sanea a 2 cifras para dia y mes.",
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
// Hora sin ceros (se sanea), con ceros, el maximo valido,
// hora y minutos fuera de rango y formato incompleto (sin segundos)
$pruebas["validaHora"] = [
    "llamada" => "validaHora(\$var, \"07:00:00\")",
    "descripcion" => "Hora hh:mm:ss valida. Se sanea a 2 cifras cada parte.",
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
// Email normal, con espacios en los extremos (se quitan), con subdominio,
// con un caracter no valido, con un espacio en medio, sin dominio y sin @
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
// Se prueban cadenas con caracteres multibyte para comprobar que
// mb_strlen cuenta caracteres y no bytes. Tambien la cadena vacia.
$pruebas["validaCadena"] = [
    "llamada" => "validaCadena(\$var, 4, \"def\")",
    "descripcion" => "Cadena de 4 caracteres como maximo (los caracteres multibyte cuentan como 1).",
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
// Expresion del nombre del ejercicio 2: no puede empezar por H ni h.
// La u final es para que funcione con caracteres multibyte (UTF-8).
$expresion = '/^[^Hh]/u';
$pruebas["validaExpresion"] = [
    "llamada" => "validaExpresion(\$var, '$expresion', \"def\")",
    "descripcion" => "Cumple la expresion regular: no empieza por H ni h.",
    "casos" => []
];
foreach (["Pedro", "angel", "Hugo", "hugo"] as $entrada) {
    $varN = $entrada;
    $okN = \VALNORMAL\validaExpresion($varN, $expresion, "def");
    $varF = $entrada;
    $okF = \VALFILTER\validaExpresion($varF, $expresion, "def");
    $pruebas["validaExpresion"]["casos"][] = [$entrada, $okN, $varN, $okF, $varF];
}


// ---------- validaRango ----------
// Se usa el array de estados del ejercicio 2.
// Tipo 1: busca en los valores. Tipo 2: busca en las claves.
// Se prueba la clave como entero y como cadena (asi llega desde $_POST),
// una clave que no existe y un tipo no valido (3).
$estados = [1 => "estudiante", 2 => "en paro", 3 => "trabajando", 4 => "jubilado"];
$pruebas["validaRango"] = [
    "llamada" => "validaRango(\$var, \$estados, \$tipo)",
    "descripcion" => "\$estados = [1 => \"estudiante\", 2 => \"en paro\", 3 => \"trabajando\", 4 => \"jubilado\"]. "
        . "Tipo 1: busca en los valores. Tipo 2: busca en las claves.",
    "casos" => []
];

// Cada caso es [valor, tipo]
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

    // validaRango no recibe $var por referencia, asi que no la modifica:
    // en las columnas de $var se muestra la entrada tal cual.
    // El tipo usado va en la posicion 5 para mostrarlo junto a la entrada.
    $pruebas["validaRango"]["casos"][] = [$entrada, $okN, $entrada, $okF, $entrada, "tipo $tipo"];
}


//dibuja la plantilla de la vista
inicioCabecera("Ej1");
cabecera();
finCabecera();
inicioCuerpo("Ej1", $barra);
cuerpo($pruebas);  //llamo a la vista
finCuerpo();
// **********************************************************


// =====================================================================
// VISTA
// =====================================================================

/**
 * Contenido extra del head: estilos propios de esta pagina.
 * Los colores usan las variables de base.css.
 */
function cabecera()
{
?>
    <!-- esto va en el head -->
    <style>
        /* Que los titulos de las columnas no se partan en dos lineas */
        #main table th {
            white-space: nowrap;
        }

        /* Resultado true en verde */
        .correcto {
            color: var(--exito);
            font-weight: 600;
        }

        /* Resultado false en rojo */
        .incorrecto {
            color: var(--error);
            font-weight: 600;
        }
    </style>
<?php
}

/**
 * Prepara un valor para mostrarlo en la pagina.
 * Las cadenas se ponen entre comillas para que se vean los espacios
 * (por ejemplo " pepe@gmail.com "). Despues se escapa con
 * htmlspecialchars para que no se interprete como HTML.
 *
 * @param mixed $valor Valor a mostrar (entero, real o cadena).
 * @return string Valor listo para escribir en el HTML.
 */
function mostrarValor(mixed $valor): string
{
    if (is_string($valor)) {
        $valor = '"' . $valor . '"';
    }
    return htmlspecialchars((string) $valor);
}

/**
 * Devuelve el resultado de una validacion coloreado:
 * true en verde y false en rojo.
 *
 * @param bool $ok Resultado devuelto por la funcion de validacion.
 * @return string HTML con el resultado.
 */
function mostrarResultado(bool $ok): string
{
    if ($ok) {
        return '<span class="correcto">true</span>';
    }
    return '<span class="incorrecto">false</span>';
}

/**
 * Cuerpo de la pagina: una tabla por cada funcion de validacion
 * con los resultados de las dos librerias.
 *
 * @param array $pruebas Resultados preparados en el controlador.
 */
function cuerpo(array $pruebas)
{
?>
    <main id="main">

        <h2>1.- Librerias de validacion</h2>
        <p class="enunciado">Se prueban las librerias val_normal.php (espacio de nombres VALNORMAL,
            con comparaciones y expresiones regulares) y val_filter.php (espacio de nombres VALFILTER,
            con la libreria FILTER). Cada funcion se llama en las dos librerias con los mismos valores,
            y se muestra lo que devuelve y como queda $var (saneado o con el valor por defecto).</p>

        <?php
        // Una seccion por cada funcion: titulo, como se llama y tabla de resultados
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
                // Una fila por cada valor probado
                foreach ($prueba["casos"] as $caso) {
                ?>
                    <tr>
                        <td>
                            <?= mostrarValor($caso[0]) ?>
                            <?php
                            if (isset($caso[5])) {
                                echo " &nbsp;(" . $caso[5] . ")";
                            }
                            ?>
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