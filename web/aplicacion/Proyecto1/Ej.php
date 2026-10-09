<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],    
    [
        "TEXTO" =>"Menu",
        "ENLACE" =>"/aplicacion/pruebas/index.php"
    ],
    [
        "TEXTO" => "Proyecto1"
    ],
    [
        "TEXTO" => "Ej¿",
        "ENLACE" => "/aplicacion/Proyecto1/Ej¿.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej¿");
cabecera();
finCabecera();
inicioCuerpo("Ej¿", $barra);
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
