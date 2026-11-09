<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//Controlador

$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "index.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Tienda");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barra);
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
        <a href="./aplicacion/Proyecto1/index.php">Proyecto1 </a> <br>
        <a href="./aplicacion/Proyecto2/index.php">Proyecto2 </a> <br>
        <a href="./aplicacion/Proyecto3/index.php">Proyecto3 </a> <br>
        <a href="./aplicacion/Proyecto4/index.php">Proyecto4 </a> <br>
        <a href="./aplicacion/pruebas/index.php">Pruebas</a>
    </main>
<?php
}
