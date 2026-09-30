<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

/*
HAY QUE PONER FUERA DE LAS CONSTANTES FUERA DE LAS FUNCIONES 
*/
const NUME = 42;
define("MUNE", 24);

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
        else echo "<br> \$Var no esta inicializada pero $var1 si";

        $cadena = null;

        echo "\n cadena = $cadena";

        $var = 125;
        $tipo = gettype($var);
        $var = (string)$var;
        $tipo = gettype($var);
        settype($var,"double");
        $tipo = gettype($var);
        $var = intval($var);
        $tipo = gettype($var);

        $var1 = 100; //100
        $var2 = $var1; //100
        $var3 =&$var1; //100
        $var1 = 200; //var1 = 200 var3 = 200
        $var2 = $var3; // var2 = 200
        unset($var3); //var1 = 200 var3 = uninitialized

        //Las constantes las definimos fuera
        $var1 += MUNE;

        $var1 += NUME;


        if(isset($Var2))
            $var1=$Var2;
        else if(isset($Var3))
            $var1=$Var3;
        else
            $var1=72;

        $var1=$Var2??$Var3??72; //Esto es lo mismo que lo de arriba

        $var1 = 1;
        switch($var1){
            case 1: $cadena = "uno";
            case 2: $cadena = "2000";
                    break;
            default: $cadena = "dos"; //Si no pones breack llega hasta aqui
        }
        $cadena;

    ?>

<?php
}
