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
 * @param array &$array Pasamos el array por referencia
 * @param string $str La cadena de indice
 * @param int $num1 Primer numero el cual se guardara en el array posicion del indice string
 * @param int &$num2 Se pasa una variable numerica donde se guardaran las llamadas a la funcion
 * @return bool Devolvemos false si $str es 2daw o primera
 * @author Julian Barreno
 */
function cuentaVeces(array &$array, string $str, int $num1, int &$num2): bool
{
    static $contador = 1;
    $num2 = $contador;
    $contador++;
    if ($str === "2daw" || $str === "primera") {
        return false;
    }
    $array[$str] = $num1;

    return true;
};



/**2.- Función generarCadena(). 
 * A esta función se le pasa un parámetro con valor por defecto 10 y se
 * encarga de devolver una cadena de longitud la indicada cuyos caracteres son generados de forma
 * aleatoria (caracteres válidos: letras mayúsculas, minúsculas y números). 
 * Devolverá false si se ha indicado un número negativo o igual a 0.
 * generarCadena(7);//crea la cadena de 7 caracteres “AcG_%15”
 */

/**
 * Creamos un array con todas las posibilidades y en un bucle que recorremos tantas veces como se nos indique en el parametro
 * iremos rellenando la cadena con caracteres aleatorios
 * @param int $num defaul 10
 * @return string|false si todo sale bien devuelve la cadena aleatoria sino devuelve false si se mando como parametro 0 o menos
 * @author Julian Barreno
 */
function generarCadena(int $num = 10): string|false
{
    if ($num <= 0) return false;
    $caracteres = mb_str_split("qwertyuioplkjhgfdsazxcvbnmMNBVCXZLKJHGFDSAQWERTYUIOP1234567890");
    $cadena = "";
    for ($i = 0; $i < $num; $i++) {
        $cadena .= $caracteres[rand(0, count($caracteres) - 1)];
    };
    return $cadena;
};



/**
 * 3.- Función operaciones(). Esta función recibe al menos tres parámetros. El primero (entero) es el
 * tipo de operación. Los demás son valores numéricos (los operandos). El tipo de operación puede ser
 * 1, suma todos los operandos
 * 2, al primer operando se restan el resto
 * 3, multiplicación de todos los operandos.
 * En cualquier otro caso se suman los operandos que ocupan las posiciones pares y se restan
 * los de las posiciones impares (el primer operando es 1).
 * Operaciones(1,2,5,7,3,4); //haría la suma de 2+5+7+3+4
 * Operaciones(5,2,5,7,3,4); //Sumaria suma las posiciones pares (5+3), las posiciones impares
 * (2+7+4), y se restan los dos.
 */

/**
 * Funcion que segun el primer numero que manden hara una ser de cosas, funciona como un menu
 * @param int $select Este marca que accion se llevara acabo
 * @param float $num1 Primer numero
 * @param float $num2 Segundo numero
 * @param float ...$numeros Sera el array de todos los demas numeros extra que me manden
 * @return float Segun el caso devuelve un resultado distinto, pero siempre es float
 * @author Julian Barreno
 */
function operaciones(int $select, float $num1, float $num2, float ...$numeros): float
{
    switch ($select) {
        case 1:
            $suma = $num1 + $num2;
            foreach ($numeros as $elem) {
                $suma += $elem;
            };
            return $suma;
        case 2:
            $resta = $num1 - $num2;
            foreach ($numeros as $elem) {
                $resta -= $elem;
            };
            return $resta;
        case 3:
            $multi = $num1 * $num2;
            foreach ($numeros as $elem) {
                $multi *= $elem;
            };
            return $multi;
        default:
            $impar = $num1;
            $par = $num2;
            foreach ($numeros as $i => $elem) {
                if (($i + 1) % 2 == 0)
                    $par += $elem;
                else
                    $impar += $elem;
            };
            return $par - $impar;
    }
};



/**
 * 4.- Función devuelve(). Esta función recibe como parámetros tres números (enteros) y devuelve la
 * suma de los tres valores en el primer parámetro y como resultado de la función el producto de los
 * tres valores. Los dos últimos parámetros tendrán definidos valor por defecto (el que queráis).
 * $valor=7;
 * devuelve($valor,4) //$valor valdrá 7+4+10 y se devuelve 7*4*10 (10 es el valor por defecto que
 * le he puesto al tercer parámetro).
 * Hacer varias llamadas a la función indicando:
 * - Los tres parámetros
 * - El primer parámetro únicamente
 * - El primer y el segundo parámetro
 * - El primer y el tercer parámetro (ojo, el segundo parámetro no se indica)
 */

/**
 * Funcion simple que pide el ejercicio, tenemos en cuenta la creacion de una variable aux para que no se scambie el
 *  resultado enviado al hacer primero la suma en $num1
 * @param int &$num1 Variable por referencia
 * @param int $num2 Default 5
 * @param int $num3 Default 10
 * @return int
 * @author Julian Barreno
 */
function devuelve(int &$num1, int $num2 = 5, int $num3 = 10): int
{
    $aux = $num1 * $num2 * $num3;
    $num1 += $num2 + $num3;
    return $aux;
}



/**
 * 5.- Se tienen las funciones suma, resta y multiplicacion que reciben cada una dos parámetros
 * numéricos (entero) y que devuelven el resultado de la operación que indica su nombre sobre los parámetros.
 *      Tenemos la Función hacerOperacion que recibe tres parámetros. El primero es una cadena
 * que puede ser suma, resta o multiplicacion. Los otros dos son los operandos. Esta función se
 * encargará de devolver el resultado de ejecutar la “cadena” con los operandos usando una variablefunción para llamar
 * a la operación. Hay que comprobar indicando una operación correcta 
 * (devuelve false si la operación no es válida).
 * hacerOperacion(“resta”,3,1) //devuelve 3-1. No se llama directamente a la función resta, se
 * tiene una variable función para ello
 */

function suma(int $num1, int $num2){return $num1 + $num2;}

function resta(int $num1, int $num2){return $num1 - $num2;}

function multiplicacion(int $num1, int $num2){return $num1 * $num2;}

function hacerOperacion(string $str, int $num1, int $num2)
{
    return in_array($str, ["suma", "resta", "multiplicacion"]) ? $str($num1, $num2) : false;
}



/**
 * 6.- Crear la función llamadaAFuncion que recibe tres operandos (entero, entero y callable) y que
 * devuelve un entero que es el resultado de llamar al parámetro callback con los otros parámetros.
 * Llamar a la función llamadaAFuncion 3 veces pasando como parámetro de callback funciones de
 * flecha distintas que tu definas
 *  llamadaAFuncion(1,2,fn($a,$b)=>$a+$b)
 * Repetir las llamadas, definiendo las 3 funciones como anónimas (se asignan a variables)
 */

function llamadaAFuncion(int $num1, int $num2, callable $fn)
{
    return $fn($num1, $num2);
}



/**
 * 7.- Función ordenar(): A esta función se le pasa un array y lo ordena mediante una llamada a usort,
 * al que se indicará como función callback una función anónima que ordenará en orden descendente
 * según el número de caracteres de cada elemento.
 * $vector=array((“uno”,“grande”,“caminos”,”a”)
 * Ordenar($vector);//el vector debe quedar (“caminos”,”grande”,”uno”,”a”)
 */

function ordenar(array &$arr)
{
    return usort($arr, fn($a, $b) => mb_strlen($b) <=> mb_strlen($a));
}
