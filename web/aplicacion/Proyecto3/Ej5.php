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
        "TEXTO" => "Ej5",
        "ENLACE" => "/aplicacion/Proyecto3/Ej5.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej5");
cabecera();
finCabecera();
inicioCuerpo("Ej5", $barra);
cuerpo();  //llamo a la vista
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
function cuerpo()
{
?>
    <main id="main">
        <br><br>

        <?php //Ejercicio 5:

        echo "5.- Se tienen las funciones suma, resta y multiplicacion que reciben cada una dos parámetros
            numéricos (entero) y que devuelven el resultado de la operación que indica su nombre sobre los parámetros. <br>
            Tenemos la Función hacerOperacion que recibe tres parámetros. El primero es una cadena <br>
            que puede ser suma, resta o multiplicacion. Los otros dos son los operandos. Esta función se <br>
            encargará de devolver el resultado de ejecutar la “cadena” con los operandos usando una variablefunción para llamar a la operación. <br>
            Hay que comprobar indicando una operación correcta (devuelve false si la operación no es válida)<br><br>";

        //Ejecucion de las funciones
        echo '<br>hacerOperacion("suma",1,2) => ' . hacerOperacion("suma", 1, 2) .
                '<br>hacerOperacion("resta",10,5) => ' . hacerOperacion("resta", 10, 5) .
                '<br>hacerOperacion("multiplicacion",3,3) => ' . hacerOperacion("multiplicacion", 3, 3);

        ?>
    </main>
<?php
}
