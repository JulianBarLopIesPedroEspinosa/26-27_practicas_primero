<?php

namespace VALFILTER;

/**
 * Regla común: todas devuelven true si el valor es correcto y false si no.
 * Las que reciben &$var devuelven en ella el valor saneado, o $defecto si no es válido.
 */

/**
 * validaEntero(int &$var, int $min, int $max, int $defecto): bool
 * Comprueba que es un entero entre $min y $max.
 */

function validaEntero(int &$var, int $min, int $max, int $defecto): bool
{
    $res = filter_var($var, FILTER_VALIDATE_INT,
        ['options' => ['min_range' => $min, 'max_range' => $max]]
    );

    if ($res === false) {
        $var = $defecto;
        return false;
    }

    return true;
}


/**
 * validaReal(float &$var, float $min, float $max, float $defecto): bool
 * Comprueba que es un real entre $min y $max.
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
 * validaFecha(string &$var, string $defecto): bool
 * Comprueba que es una fecha válida con formato dd/mm/aaaa.
 */

function validaFecha(string &$var, string $defecto): bool{

    
    $res = filter_var($var, FILTER_VALIDATE_REGEXP,
        ['options' => ['regexp' => '/^\d{1,2}\/\d{1,2}\/\d{4}$/']]
    );

    if ($res === false) {
        $var = $defecto;
        return false;
    }

    
    $partes = explode('/', $var);
    $dia  = $partes[0];
    $mes  = $partes[1];
    $anio = $partes[2];

    
    if (!checkdate((int) $mes, (int) $dia, (int) $anio)) {
        $var = $defecto;
        return false;
    }

    $var = str_pad($dia,2,"0",STR_PAD_LEFT)."/".str_pad($mes,2,"0",STR_PAD_LEFT)."/".$anio;

    return true;
}

/**
 * validaHora(string &$var, string $defecto): bool
 * Comprueba que es una hora válida con formato hh:mm:ss.
 */

function validaHora(string &$var, string $defecto): bool{

    
    $res = filter_var($var, FILTER_VALIDATE_REGEXP,
        ['options' => ['regexp' => '/^\d{1,2}:\d{1,2}:\d{1,2}$/']]
    );

    if ($res === false) {
        $var = $defecto;
        return false;
    }

    
    $partes = explode(':', $var);
    $hora  = $partes[0];
    $min  = $partes[1];
    $seg = $partes[2];  

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

    $var = str_pad($hora,2,"0",STR_PAD_LEFT).":".str_pad($min,2,"0",STR_PAD_LEFT).":".str_pad($seg,2,"0",STR_PAD_LEFT);

    return true;
}
/**
 * validaEmail(string &$var, string $defecto): bool
 * Comprueba que $var es un email correcto (aaaaa@bbbb.ccc).
 */
function validaEmail(string &$var, string $defecto): bool
{
    $var = trim($var);  

    if (filter_var($var, FILTER_VALIDATE_EMAIL) === false) {
        $var = $defecto;
        return false;
    }

    $var = filter_var($var, FILTER_SANITIZE_EMAIL);
    return true;
}

/**
 * validaCadena(string &$var, int $longitud, string $defecto): bool
 * Comprueba que la longitud no pasa de $longitud.
 */
function validaCadena(string &$var, int $longitud, string $defecto): bool
{
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
        if (!is_int($var) && !is_string($var)) {
            return false;
        }
        return array_key_exists($var, $posibles);
    }

    return false;   
}