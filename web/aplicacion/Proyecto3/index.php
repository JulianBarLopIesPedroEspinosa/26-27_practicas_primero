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
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Proyecto3");
cabecera();
finCabecera();
inicioCuerpo("Proyecto3", $barra);
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

        <a href="Ej1.php">Ej1 </a>   <br>
        <a href="Ej2.php">Ej2 </a>   <br>
        <a href="Ej3.php">Ej3 </a>   <br>
        <a href="Ej4.php">Ej4 </a>   <br>
        <a href="Ej5.php">Ej5 </a>   <br>

    </main>
<?php
}
