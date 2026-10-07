<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//dibuja la plantilla de la vista
inicioCabecera("Ej1 Libreria path");
cabecera();
finCabecera();
inicioCuerpo("Ej1 Libreria path");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {

    ?>
    <!-- esto va en el head -->
    <?php

}

//vista
function cuerpo()
{
?>
    <main id="main">
    <br><br>

<?php //Ejercicio 1:
    echo "1.- Mostrar el funcionamiento de diversas funciones Matemáticas (round,
            floor, pow, sqrt, entero a hexadecimal, de base 4 a base 8 y al menos
            dos funciones mas distintas de las anteriores)
            <br>Definir variables inicializadas con valores en binario, octal y hexadecimal.
            <br>Mostrar el valor de esas variables tanto en decimal como en la base 
            en la que se han definido.
            <br>Hacer este ejercicio directamente en la vista (definiciones de las variables 
            y visualización de las mismas)";

    /* En esta funcion vamos a mostrar una lista de ejemplos del modulo Math*/
    function funcionesMatematicas(){
        echo "<br><br><br>Funciones matematicas: round, floor, pow, sqrt.<br>";
        
        echo "<br>round: Redondea un número de punto flotante. round(num)";
        redondeo(2.5);
        redondeo(-2.5);

        echo "<br><br>floor: Redondea hacia el entero inferior. floor(num)";
        redondeoAbajo(2.5);
        redondeoAbajo(-2.5);

        echo "<br><br>pow: Devuelve num elevado a la potencia exponent. pow(num,exponent)
              <br>Ejemplo: 2 elevado a 3 => pow(2,3) = ".pow(2,3);
        
        echo "<br><br>sqrt: Raíz cuadrada. sqrt(num)
              <br>Ejemplo: raíz cuadrada de 8 => sqrt(8) = ".sqrt(4); 
    };

    function redondeo($redondeo){ //Esta es la funcion para el ejemplo de round
        echo "<br>Ejemplo: {$redondeo} => round({$redondeo}) = ".round($redondeo);
    };
    function redondeoAbajo($num){ //Esta es la funcion para el ejemplo de floor
        echo "<br>Ejemplo: {$num} => floor({$num}) = ".floor($num);
    };

    /* En esta funcion cargamos los ejemplos de pasar de entero a hexadecimal y de 
        base 4 a base 8*/
    function hexadecimalNibble(){
        echo "<br><br><br>De entero a hexadcimal, y de base 4 a base 8.
                <br><br>dechex: Convierte de decimal a hexadecimal. dechex(num)
                <br>Ejemplo: 255 a hexadecimal => dechex(255) = ".dechex(255);
        echo "<br><br>base_convert: Convierte un número entre bases arbitrarias. 
                base_convert(\"num\", from_base, to_base)
                <br>Ejemplo: 31 de base 4 a base 8 => base_convert(\"31\",4,8) = ".base_convert("31",4,8);
    };

    /* Aqui vamos a mostrar 3 variables definidas en binario, octal y hexadecimal,
        y luego las mostraremos tanto en decimal como en su base original */
    function binOctHex(){
        // Definición de variables con distintos prefijos
        $bin = 0b1010;   
        $oct = 0o12;     
        $hex = 0xA;     

        // Mostrar en decimal 
        echo "<br><br><br>Tres variables, binario, octal, hexadecimal:
                <br><br>Decimal: $bin => Binario: 1010.  
                <br>Decimal: $oct => Octal: 12.
                <br>Decimal: $hex => Hexadecimal: A.";  
    };

    //Llamamos a las funciones que cargaran los apartados del ejercicio
    funcionesMatematicas();
    hexadecimalNibble();
    binOctHex();
            

    ?>
    </main>
    <?php
}
