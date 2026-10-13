<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "Menu",
        "ENLACE" => "/aplicacion/pruebas/index.php"
    ],
    [
        "TEXTO" => "Proyecto2"
    ],
    [
        "TEXTO" => "Ej2",
        "ENLACE" => "/aplicacion/Proyecto2/Ej2.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej2");
cabecera();
finCabecera();
inicioCuerpo("Ej2", $barra);
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

        <?php //Ejercicio 2:




        //Ejecucion de las funciones


        ?>
    </main>
<?php
}
