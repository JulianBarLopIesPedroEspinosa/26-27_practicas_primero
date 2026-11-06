<?php

namespace VALNORMAL;

use DateTime;


/*
 * Regla común: todas devuelven true si el valor es correcto y false si no. 
 * Las que reciben &$var devuelven en ella el valor saneado, o $defecto si no es válido.
 */

/**
 * validaEntero(int &$var, int $min, int $max, int $defecto): bool
 * Comprueba que es un entero entre $min y $max.
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
 * validaReal(float &$var, float $min, float $max, float $defecto): bool
 * Comprueba que es un real entre $min y $max.
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
 * validaFecha(string &$var, string $defecto): bool
 * Comprueba que es una fecha válida con formato dd/mm/aaaa.
 */
function validaFecha(string &$var, string $defecto): bool
{
    if (!preg_match('/^((\d{1,2})\/(\d{1,2})\/(\d{4}))$/', $var, $fecha)) {
        $var = $defecto;
        return false;
    }

    $dia = $fecha[1];
    $mes = $fecha[2];
    $year = $fecha[3];

    if (!checkdate((int) $mes, (int) $dia, (int) $year)) {
        $var = $defecto;
        return false;
    }

    $var = str_pad($dia, 2, "0", STR_PAD_LEFT) . "/" . str_pad($mes, 2, "0", STR_PAD_LEFT) . "/" . $year;

    return true;
}


/**
 * validaHora(string &$var, string $defecto): bool
 * Comprueba que es una hora válida con formato hh:mm:ss.
 */

function validaHora(string &$var, string $defecto): bool{

    if (!preg_match('/^((\d{1,2}):(\d{1,2}):(\d{1,2}))$/', $var, $array)) {
        $var = $defecto;
        return false;
    }

    $hora = $array[1];
    $min  = $array[2];
    $seg  = $array[3];

    // rangos: hora 0-23, minutos y segundos 0-59
    if ((int) $hora > 23 || (int) $min > 59 || (int) $seg > 59) {
        $var = $defecto;
        return false;
    }

        $var = str_pad($hora, 2, "0", STR_PAD_LEFT) . "/" . str_pad($min, 2, "0", STR_PAD_LEFT) . "/" . str_pad($seg, 2, "0", STR_PAD_LEFT);


return true;
}


/**
 * validaEmail(string &$var, string $defecto): bool
 * Comprueba que $var es un email correcto (aaaaa@bbbb.ccc).
 */
function validaEmail(string &$var, string $defecto): bool
{
    $var = trim($var);
    $expresion = '/^[\w.+-]+@[\w-]+(\.[\w-]+)*\.[a-z]{2,}$/i';
 
    if (!preg_match($expresion, $var)) {
        $var = $defecto;
        return false;
    }
 
    return true;
}
 
 
/**
 * validaCadena(string &$var, int $longitud, string $defecto): bool
 * Comprueba que la longitud no pasa de $longitud.
 */
function validaCadena(string &$var, int $longitud, string $defecto): bool
{
    // mb_strlen cuenta caracteres, no bytes (la ñ cuenta como 1)
    if (mb_strlen($var) > $longitud) {
        $var = $defecto;
        return false;
    }
 
    return true;
}
 
 
/**
 * validaExpresion(string &$var, string $expresion, string $defecto): bool
 * Comprueba que $var cumple la expresión regular $expresion.
 */
function validaExpresion(string &$var, string $expresion, string $defecto): bool
{
    if (!preg_match($expresion, $var)) {
        $var = $defecto;
        return false;
    }
 
    return true;
}
 
 
/**
 * validaRango(mixed $var, array $posibles, int $tipo = 1): bool
 * Con $tipo = 1: comprueba que $var es uno de los valores de $posibles.
 * Con $tipo = 2: comprueba que $var es una de las claves de $posibles.
 */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool
{
    if ($tipo == 1) {
        return in_array($var, $posibles);
    }
 
    if ($tipo == 2) {
        // las claves de un array solo pueden ser enteros o cadenas
        if (!is_int($var) && !is_string($var)) {
            return false;
        }
        return array_key_exists($var, $posibles);
    }
 
    return false;   // $tipo no válido
}
 