<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
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




        //Ejecucion de las funciones


        ?>
    </main>
<?php
}
