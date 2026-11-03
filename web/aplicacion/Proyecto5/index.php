
<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "Proyecto5",
        "ENLACE" => "/aplicacion/Proyecto5/index.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Proyecto5");
cabecera();
finCabecera();
inicioCuerpo("Proyecto5", $barra);
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

        

    </main>
<?php
}
/*
class="enunciado"
class="resultado"*/