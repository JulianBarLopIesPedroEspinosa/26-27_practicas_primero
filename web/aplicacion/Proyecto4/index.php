<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "Proyecto4",
    ],
    [
        "TEXTO" => "Proyecto4",
        "ENLACE" => "/aplicacion/Proyecto4/index.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Proyecto4");
cabecera();
finCabecera();
inicioCuerpo("Proyecto4", $barra);
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

        <a href="Ej1.php">Ej1 </a>   

    </main>
<?php
}
