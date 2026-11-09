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
        "TEXTO" => "Ej7",
        "ENLACE" => "/aplicacion/Proyecto3/Ej7.php"
    ]
];

$vector=array("uno","grande","caminos","a");

//dibuja la plantilla de la vista
inicioCabecera("Ej7");
cabecera();
finCabecera();
inicioCuerpo("Ej7", $barra);
cuerpo($vector);  //llamo a la vista
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
function cuerpo(array &$vector)
{
?>
    <main id="main">
        <br><br>

        <?php //Ejercicio 7:

        echo "7.- Función ordenar(): A esta función se le pasa un array y lo ordena mediante una llamada a usort,
                al que se indicará como función callback una función anónima que ordenará en orden descendente
                según el número de caracteres de cada elemento. <br><br><br>";

        //Ejecucion de las funciones
        echo "Ejemplo:<br> \$vector=array((“uno”,“grande”,“caminos”,”a”)  =>  ";
        ordenar($vector);
        foreach($vector as $elem){
            echo $elem . " - ";
        }

        ?>
    </main>
<?php
}
