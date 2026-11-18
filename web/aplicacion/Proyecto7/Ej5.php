<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    
    [
        "TEXTO" => "Proyecto7",
        "ENLACE" => "/aplicacion/Proyecto7/index.php"
    ],
    [
        "TEXTO" => "Ej5",
        "ENLACE" => "/aplicacion/Proyecto7/Ej5.php"
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

        <?php //Ejercicio ¿:




        //Ejecucion de las funciones


        ?>
    </main>
<?php
}
