<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include_once("./libreria.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    
    [
        "TEXTO" => "Proyecto3",
        "ENLACE" => "/aplicacion/Proyecto3/index.php"
    ],
    [
        "TEXTO" => "Ej6",
        "ENLACE" => "/aplicacion/Proyecto3/Ej6.php"
    ]
];

$suma = function($a,$b){return $a + $b;};
$resta = function($a,$b){return $a - $b;};
$multi = function($a,$b){return $a * $b;};


//dibuja la plantilla de la vista
inicioCabecera("Ej6");
cabecera();
finCabecera();
inicioCuerpo("Ej6", $barra);
cuerpo($suma, $resta, $multi);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{

?>
    <!-- esto va en el head -->
<?php

}

//vista
function cuerpo($suma, $resta, $multi)
{
?>
    <main id="main">
        <br><br>

        <?php //Ejercicio 6:

        echo "6.- Crear la función llamadaAFuncion que recibe tres operandos (entero, entero y callable) y que
                devuelve un entero que es el resultado de llamar al parámetro callback con los otros parámetros.
                Llamar a la función llamadaAFuncion 3 veces pasando como parámetro de callback funciones de
                flecha distintas que tu definas <br>
                llamadaAFuncion(1,2,fn(\$a,\$b)=>\$a+\$b) <br>
                Repetir las llamadas, definiendo las 3 funciones como anónimas (se asignan a variables)<br><br>";   

        
        //Ejecucion de las funciones
        echo "<br> llamadaAFuncion(2,2,fn(\$a,\$b)=>\$a+\$b) => ".llamadaAFuncion(2,2,fn($a,$b)=>$a+$b).
            "<br> llamadaAFuncion(2,2,fn(\$a,\$b)=>\$a-\$b) => ".llamadaAFuncion(2,2,fn($a,$b)=>$a-$b).
            "<br> llamadaAFuncion(2,2,fn(\$a,\$b)=>\$a*\$b) => ".llamadaAFuncion(2,2,fn($a,$b)=>$a*$b).
            "<br> llamadaAFuncion(2,2,\$suma) => ".llamadaAFuncion(2,2,$suma).
            "<br> llamadaAFuncion(2,2,\$resta) => ".llamadaAFuncion(2,2,$resta).
            "<br> llamadaAFuncion(2,2,\$multi) => ".llamadaAFuncion(2,2,$multi);

        ?>
    </main>
<?php
}
