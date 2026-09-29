<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Pruebas basicas");
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
    <br><br>esto es html <br><br>  
    <?php
        echo "Y esto un echo en php"; //Esto es un comentario php

        $var1 = 25;
        $cadena = "Esto es una cadena";

        $var1 += 12;
       /* error_reporting(0); Esto es para que no salga Error
        echo $Var1;
        */

        if(isset($Var))
            echo $Var;
        else echo "<br>\$Var no esta inicializada"



    ?>

<?php
}
