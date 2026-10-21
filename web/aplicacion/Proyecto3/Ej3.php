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
        "TEXTO" => "Ej3",
        "ENLACE" => "/aplicacion/Proyecto3/Ej3.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej3");
cabecera();
finCabecera();
inicioCuerpo("Ej3", $barra);
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

        <?php //Ejercicio 3:

        echo "3.- Función operaciones(). Esta función recibe al menos tres parámetros. El primero (entero) es el
                tipo de operación. Los demás son valores numéricos (los operandos). El tipo de operación puede ser <br>
                1, suma todos los operandos<br>
                2, al primer operando se restan el resto<br>
                3, multiplicación de todos los operandos.<br>
                En cualquier otro caso se suman los operandos que ocupan las posiciones pares y se restan
                los de las posiciones impares (el primer operando es 1).<br><br>";


        //Ejecucion de las funciones
        echo "<br>operaciones(1,5,2,1,1,1) => ". operaciones(1,5,2,1,1,1);
        echo "<br>operaciones(2,5,2,1,1,1) => ". operaciones(2,5,2,1,1,1);
        echo "<br>operaciones(3,2,2,2,2,2) => ". operaciones(3,2,2,2,2,2);
        echo "<br>operaciones(7,3,2,1,3,1) => ". operaciones(7,3,2,1,3,1);
        

        ?>
    </main>
<?php
}
