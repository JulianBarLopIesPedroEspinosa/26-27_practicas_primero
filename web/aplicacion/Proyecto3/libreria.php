<?php

/**
 * 1.- Función cuentaVeces(). A esta función se le pasan cuatro parámetros: un array, una cadena y dos
 *        números. La función se encargará de añadir en el array el primer número a la posición asociativa
 *        indicada por la cadena. Hay que tener en cuenta que el array debe quedar actualizado cuando se
 *        salga de la función. Además, cada vez que se llama a la función, se devuelve en el segundo número
 *        un valor que corresponde con el número de llamada actual (1 para la primera, 2 para la segunda
 *        llamada, etc). Se devolverá true si todo ha ido bien y false si se ha detectado algún error. (se debe
 *        dar error si se indica como posición“2daw”o “primera”)
 */

/**
 * En esta funcion se nos pasa el array por referencia para poder cambiarlo y que se refleje fuera de la funcion
 * y lo mismo hacemos con el num2 para poder "devolverlo", y hacemos la condicion al inicio 
 * @param array &array Pasamos el array por referencia
 * @param string $str La cadena de indice
 * @param int $num1 Primer numero el cual se guardara en el array posicion del indice string
 * @param int &$num2 Se pasa una variable numerica donde se guardaran las llamadas a la funcion
 * @return true|false Devolvemos false si $str es 2daw o primera
 */
function cuentaVeces(array &$array, string $str, int $num1, int &$num2)
{
    if ($str === "2daw" || $str === "primera") {
        return false;
    }
    static $contador = 1;
    $array[$str] = $num1;
    $num2 = $contador;
    $contador++;
    return true;
};
