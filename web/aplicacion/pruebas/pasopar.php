<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador//{


//datos basicos
$nombre = "Julian";
$edad = 30;

$basicos = [
    "nombre" => $nombre,
    "edad" => $edad
];

//relleno otras
$otras = rellenarOtras();

// }

//dibuja la plantilla de la vista
inicioCabecera("Mi aplicacion");
cabecera();
finCabecera();
inicioCuerpo("Paso Parametros");
cuerpo($basicos, $otras);  //llamo a la vista
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
function cuerpo($bas, $ot)
{
?>
    <br><br>
<?php

    echo "Mi nombre es {$bas["nombre"]} de {$bas["edad"]} años".PHP_EOL;
    echo "Con otros datos {$ot}";

}

function rellenarOtras(){
    return " 2 de DAW";
}