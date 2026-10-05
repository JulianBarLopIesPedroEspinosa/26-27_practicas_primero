<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{}

//vista
function cuerpo()
{
?>
    <br><br>
    <main id="main">
    Elemento de pruebas
    <br><br>
    <a href="basicas.php">Funcionamiento basico</a>   
    <a href="pasopar.php">Paso parametros</a>   
    <a href="../Proyecto1/Ej1.php">Ej1 Libreria Math</a>   
    </main>
<?php
}
