<?php

/**
 * Libreria de validacion CON la libreria FILTER de PHP.
 *
 * Relacion 5 - Ejercicio 1. Valida con filter_var y sus filtros
 * (FILTER_VALIDATE_INT, FILTER_VALIDATE_FLOAT, FILTER_VALIDATE_REGEXP,
 * FILTER_VALIDATE_EMAIL...). Cuando FILTER no tiene un filtro concreto
 * para un caso (validaCadena y validaRango), se copia lo hecho en la
 * libreria sin FILTER (val_normal.php), como indica el enunciado.
 *
 * Tiene su propio espacio de nombres (VALFILTER) para poder usarla a la vez
 * que val_normal.php (VALNORMAL), que tiene funciones con los mismos nombres.
 *
 * Regla comun:
 *  - Todas devuelven true si el valor es correcto y false si no.
 *  - Las que reciben &$var (por referencia) devuelven en ella el valor
 *    saneado si es correcto, o $defecto si no es valido.
 *  - No se usa la opcion 'default' de filter_var: si el filtro falla
 *    devuelve false, y el valor por defecto se asigna a mano.
 */

namespace VALFILTER;


/**
 * Comprueba que $var es un entero entre $min y $max (ambos incluidos).
 * No hace falta comprobar que es entero: el tipo int del parametro ya lo
 * garantiza. El filtro solo comprueba el rango con min_range y max_range.
 *
 * @param int $var Valor a comprobar. Si no es valido se le asigna $defecto.
 * @param int $min Valor minimo permitido.
 * @param int $max Valor maximo permitido.
 * @param int $defecto Valor que se asigna a $var si no es valido.
 * @return bool true si es correcto, false si no.
 */
function validaEntero(int &$var, int $min, int $max, int $defecto): bool
{
    // filter_var devuelve el valor si esta en el rango, o false si no
    $res = filter_var($var, FILTER_VALIDATE_INT,
        ['options' => ['min_range' => $min, 'max_range' => $max]]
    );

    // === false y no !$res: el 0 es un valor valido y !0 seria true
    if ($res === false) {
        $var = $defecto;
        return false;
    }

    return true;
}


/**
 * Comprueba que $var es un real entre $min y $max (ambos incluidos).
 *
 * @param float $var Valor a comprobar. Si no es valido se le asigna $defecto.
 * @param float $min Valor minimo permitido.
 * @param float $max Valor maximo permitido.
 * @param float $defecto Valor que se asigna a $var si no es valido.
 * @return bool true si es correcto, false si no.
 */
function validaReal(float &$var, float $min, float $max, float $defecto): bool
{
    $res = filter_var($var, FILTER_VALIDATE_FLOAT,
        ['options' => ['min_range' => $min, 'max_range' => $max]]
    );

    if ($res === false) {
        $var = $defecto;
        return false;
    }

    return true;
}


/**
 * Comprueba que $var es una fecha valida con formato dd/mm/aaaa.
 * Se sanea a 2 cifras para el dia y el mes: 1/2/2023 -> 01/02/2023.
 *
 * FILTER no tiene un filtro para fechas, asi que:
 *  1. FILTER_VALIDATE_REGEXP comprueba el formato.
 *  2. checkdate comprueba que la fecha existe (31/02, bisiestos...).
 *
 * @param string $var Fecha a comprobar. Se devuelve saneada o con $defecto.
 * @param string $defecto Valor que se asigna a $var si no es valida.
 * @return bool true si es correcta, false si no.
 */
function validaFecha(string &$var, string $defecto): bool
{
    // Formato: 1 o 2 cifras para el dia y el mes, 4 para el año
    $res = filter_var($var, FILTER_VALIDATE_REGEXP,
        ['options' => ['regexp' => '/^\d{1,2}\/\d{1,2}\/\d{4}$/']]
    );

    if ($res === false) {
        $var = $defecto;
        return false;
    }

    // Se separan las tres partes de la fecha
    $partes = explode('/', $var);
    $dia  = $partes[0];
    $mes  = $partes[1];
    $anio = $partes[2];

    // ¿Existe la fecha? checkdate recibe mes, dia, año (en ese orden)
    // y enteros: (int) porque las partes son cadenas
    if (!checkdate((int) $mes, (int) $dia, (int) $anio)) {
        $var = $defecto;
        return false;
    }

    // Saneado: se rellena con un 0 a la izquierda hasta tener 2 cifras.
    // El año no se toca: la expresion regular ya obliga a que tenga 4.
    $var = str_pad($dia, 2, "0", STR_PAD_LEFT) . "/" .
           str_pad($mes, 2, "0", STR_PAD_LEFT) . "/" .
           $anio;

    return true;
}


/**
 * Comprueba que $var es una hora valida con formato hh:mm:ss.
 * Se sanea a 2 cifras cada parte: 0:5:1 -> 00:05:01.
 *
 * FILTER no tiene un filtro para horas, asi que:
 *  1. FILTER_VALIDATE_REGEXP comprueba el formato.
 *  2. FILTER_VALIDATE_INT comprueba el rango de cada parte.
 *
 * @param string $var Hora a comprobar. Se devuelve saneada o con $defecto.
 * @param string $defecto Valor que se asigna a $var si no es valida.
 * @return bool true si es correcta, false si no.
 */
function validaHora(string &$var, string $defecto): bool
{
    // Formato: 1 o 2 cifras para la hora, los minutos y los segundos
    $res = filter_var($var, FILTER_VALIDATE_REGEXP,
        ['options' => ['regexp' => '/^\d{1,2}:\d{1,2}:\d{1,2}$/']]
    );

    if ($res === false) {
        $var = $defecto;
        return false;
    }

    // Se separan las tres partes de la hora
    $partes = explode(':', $var);
    $hora = $partes[0];
    $min  = $partes[1];
    $seg  = $partes[2];

    // Rangos: hora 0-23, minutos y segundos 0-59.
    // Se convierte con (int) antes de filtrar porque FILTER_VALIDATE_INT
    // rechaza los numeros con ceros a la izquierda ("07" daria false).
    $okHora = filter_var((int) $hora, FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 0, 'max_range' => 23]]);
    $okMin  = filter_var((int) $min, FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 0, 'max_range' => 59]]);
    $okSeg  = filter_var((int) $seg, FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 0, 'max_range' => 59]]);

    if ($okHora === false || $okMin === false || $okSeg === false) {
        $var = $defecto;
        return false;
    }

    // Saneado: cada parte con 2 cifras
    $var = str_pad($hora, 2, "0", STR_PAD_LEFT) . ":" .
           str_pad($min, 2, "0", STR_PAD_LEFT) . ":" .
           str_pad($seg, 2, "0", STR_PAD_LEFT);

    return true;
}


/**
 * Comprueba que $var es un email correcto (aaaaa@bbbb.ccc).
 * Se ignoran los espacios del principio y del final.
 *
 * Primero se valida y despues se sanea: lo que se comprueba es lo que
 * escribio el usuario. Si se saneara antes, un email mal escrito como
 * pe(pe@gmail.com se "arreglaria" y se daria por bueno.
 *
 * @param string $var Email a comprobar. Se devuelve saneado o con $defecto.
 * @param string $defecto Valor que se asigna a $var si no es valido.
 * @return bool true si es correcto, false si no.
 */
function validaEmail(string &$var, string $defecto): bool
{
    // Quita espacios, tabuladores y saltos de linea de los extremos
    $var = trim($var);

    if (filter_var($var, FILTER_VALIDATE_EMAIL) === false) {
        $var = $defecto;
        return false;
    }

    // Saneado: quita los caracteres que no pueden ir en un email
    $var = filter_var($var, FILTER_SANITIZE_EMAIL);
    return true;
}


/**
 * Comprueba que $var no tiene mas de $longitud caracteres.
 * FILTER no tiene un filtro para esto: es la misma funcion que en
 * val_normal.php.
 *
 * @param string $var Cadena a comprobar. Si no es valida se le asigna $defecto.
 * @param int $longitud Numero maximo de caracteres.
 * @param string $defecto Valor que se asigna a $var si no es valida.
 * @return bool true si es correcta, false si no.
 */
function validaCadena(string &$var, int $longitud, string $defecto): bool
{
    // mb_strlen cuenta caracteres y no bytes (la ñ cuenta como 1)
    if (mb_strlen($var) > $longitud) {
        $var = $defecto;
        return false;
    }

    return true;
}


/**
 * Comprueba que $var cumple la expresion regular $expresion.
 *
 * @param string $var Cadena a comprobar. Si no es valida se le asigna $defecto.
 * @param string $expresion Expresion regular con sus delimitadores (ej: '/^[^Hh]/u').
 * @param string $defecto Valor que se asigna a $var si no es valida.
 * @return bool true si la cumple, false si no.
 */
function validaExpresion(string &$var, string $expresion, string $defecto): bool
{
    $res = filter_var($var, FILTER_VALIDATE_REGEXP,
        ['options' => ['regexp' => $expresion]]
    );

    if ($res === false) {
        $var = $defecto;
        return false;
    }

    return true;
}


/**
 * Comprueba que $var es uno de los posibles:
 *  - $tipo = 1: uno de los valores del array $posibles.
 *  - $tipo = 2: una de las claves del array $posibles.
 * No recibe $var por referencia ni tiene $defecto: solo devuelve true o false.
 * FILTER no tiene un filtro para esto: es la misma funcion que en
 * val_normal.php.
 *
 * @param mixed $var Valor a buscar.
 * @param array $posibles Array con los valores o claves permitidos.
 * @param int $tipo 1 para buscar en los valores, 2 para buscar en las claves.
 * @return bool true si esta, false si no (o si $tipo no es 1 ni 2).
 */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool
{
    // Busca en los valores. Sin el tercer parametro de in_array la
    // comparacion no mira el tipo: "3" y 3 cuentan como iguales,
    // que es lo que interesa con los datos que llegan de un formulario
    if ($tipo == 1) {
        return in_array($var, $posibles);
    }

    // Busca en las claves. Las claves de un array solo pueden ser
    // enteros o cadenas: con otro tipo array_key_exists daria error
    if ($tipo == 2) {
        if (!is_int($var) && !is_string($var)) {
            return false;
        }
        return array_key_exists($var, $posibles);
    }

    // $tipo no valido
    return false;
}