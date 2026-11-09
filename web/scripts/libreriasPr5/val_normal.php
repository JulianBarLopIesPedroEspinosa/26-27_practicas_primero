<?php

/**
 * Libreria de validacion SIN la libreria FILTER de PHP.
 *
 * Relacion 5 - Ejercicio 1. Valida con comparaciones (<, >, <=, >=) y con
 * expresiones regulares (preg_match). No hace falta usar las funciones
 * is_xxx (is_int, is_float...) porque el tipo de los parametros ya
 * garantiza el tipo del valor.
 *
 * Tiene su propio espacio de nombres (VALNORMAL) para poder usarla a la vez
 * que val_filter.php (VALFILTER), que tiene funciones con los mismos nombres.
 *
 * Regla comun:
 *  - Todas devuelven true si el valor es correcto y false si no.
 *  - Las que reciben &$var (por referencia) devuelven en ella el valor
 *    saneado si es correcto, o $defecto si no es valido.
 */

namespace VALNORMAL;


/**
 * Comprueba que $var es un entero entre $min y $max (ambos incluidos).
 *
 * @param int $var Valor a comprobar. Si no es valido se le asigna $defecto.
 * @param int $min Valor minimo permitido.
 * @param int $max Valor maximo permitido.
 * @param int $defecto Valor que se asigna a $var si no es valido.
 * @return bool true si es correcto, false si no.
 */
function validaEntero(int &$var, int $min, int $max, int $defecto): bool
{
    if ($var <= $max && $var >= $min) {
        return true;
    }

    $var = $defecto;
    return false;
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
    if ($var <= $max && $var >= $min) {
        return true;
    }

    $var = $defecto;
    return false;
}


/**
 * Comprueba que $var es una fecha valida con formato dd/mm/aaaa.
 * Se sanea a 2 cifras para el dia y el mes: 1/2/2023 -> 01/02/2023.
 *
 *  1. La expresion regular comprueba el formato y separa las partes.
 *  2. checkdate comprueba que la fecha existe (31/02, bisiestos...).
 *
 * @param string $var Fecha a comprobar. Se devuelve saneada o con $defecto.
 * @param string $defecto Valor que se asigna a $var si no es valida.
 * @return bool true si es correcta, false si no.
 */
function validaFecha(string &$var, string $defecto): bool
{
    // Cada parentesis captura una parte en $fecha:
    // $fecha[0] es la coincidencia entera, [1] el dia, [2] el mes y [3] el año.
    // 1 o 2 cifras para el dia y el mes, 4 para el año.
    if (!preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $var, $fecha)) {
        $var = $defecto;
        return false;
    }

    $dia = $fecha[1];
    $mes = $fecha[2];
    $year = $fecha[3];

    // ¿Existe la fecha? checkdate recibe mes, dia, año (en ese orden)
    // y enteros: (int) porque las partes capturadas son cadenas
    if (!checkdate((int) $mes, (int) $dia, (int) $year)) {
        $var = $defecto;
        return false;
    }

    // Saneado: se rellena con un 0 a la izquierda hasta tener 2 cifras.
    // El año no se toca: la expresion regular ya obliga a que tenga 4.
    $var = str_pad($dia, 2, "0", STR_PAD_LEFT) . "/" .
           str_pad($mes, 2, "0", STR_PAD_LEFT) . "/" .
           $year;

    return true;
}


/**
 * Comprueba que $var es una hora valida con formato hh:mm:ss.
 * Se sanea a 2 cifras cada parte: 0:5:1 -> 00:05:01.
 *
 *  1. La expresion regular comprueba el formato y separa las partes.
 *  2. Con comparaciones se comprueba el rango de cada parte.
 *
 * @param string $var Hora a comprobar. Se devuelve saneada o con $defecto.
 * @param string $defecto Valor que se asigna a $var si no es valida.
 * @return bool true si es correcta, false si no.
 */
function validaHora(string &$var, string $defecto): bool
{
    // Cada parentesis captura una parte en $partes:
    // [1] la hora, [2] los minutos y [3] los segundos (1 o 2 cifras cada una)
    if (!preg_match('/^(\d{1,2}):(\d{1,2}):(\d{1,2})$/', $var, $partes)) {
        $var = $defecto;
        return false;
    }

    $hora = $partes[1];
    $min  = $partes[2];
    $seg  = $partes[3];

    // Rangos: hora 0-23, minutos y segundos 0-59.
    // No hace falta comprobar si son negativos: la expresion regular
    // solo deja pasar digitos.
    if ((int) $hora > 23 || (int) $min > 59 || (int) $seg > 59) {
        $var = $defecto;
        return false;
    }

    // Saneado: cada parte con 2 cifras, separadas por :
    $var = str_pad($hora, 2, "0", STR_PAD_LEFT) . ":" .
           str_pad($min, 2, "0", STR_PAD_LEFT) . ":" .
           str_pad($seg, 2, "0", STR_PAD_LEFT);

    return true;
}


/**
 * Comprueba que $var es un email correcto (aaaaa@bbbb.ccc).
 * Se ignoran los espacios del principio y del final.
 * El saneado es solo el trim: la expresion regular ya no deja pasar
 * caracteres que no puedan ir en un email.
 *
 * @param string $var Email a comprobar. Se devuelve saneado o con $defecto.
 * @param string $defecto Valor que se asigna a $var si no es valido.
 * @return bool true si es correcto, false si no.
 */
function validaEmail(string &$var, string $defecto): bool
{
    // Quita espacios, tabuladores y saltos de linea de los extremos
    $var = trim($var);

    // [\w.+-]+          usuario: letras, numeros, _ . + -
    // @                 la arroba
    // [\w-]+            dominio: letras, numeros, _ -
    // (\.[\w-]+)*       subdominios opcionales (ej: correo.iesx.es)
    // \.[a-z]{2,}       extension final: un punto y al menos 2 letras
    // i                 no distingue mayusculas y minusculas
    $expresion = '/^[\w.+-]+@[\w-]+(\.[\w-]+)*\.[a-z]{2,}$/i';

    if (!preg_match($expresion, $var)) {
        $var = $defecto;
        return false;
    }

    return true;
}


/**
 * Comprueba que $var no tiene mas de $longitud caracteres.
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
    // preg_match devuelve 1 si la cumple y 0 si no
    if (!preg_match($expresion, $var)) {
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