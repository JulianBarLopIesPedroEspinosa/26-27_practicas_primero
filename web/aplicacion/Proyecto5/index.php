<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "Proyecto5"
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

        <a href="Ej1/index.php">Ej1 </a>   <br>
        <a href="Ej2/formulario.php">Ej2 </a>   <br>

    </main>
<?php
}
