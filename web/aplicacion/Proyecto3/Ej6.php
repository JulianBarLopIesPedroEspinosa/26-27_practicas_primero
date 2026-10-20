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


//dibuja la plantilla de la vista
inicioCabecera("Ej6");
cabecera();
finCabecera();
inicioCuerpo("Ej6", $barra);
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

        <?php //Ejercicio 6:




        //Ejecucion de las funciones


        ?>
    </main>
<?php
}
