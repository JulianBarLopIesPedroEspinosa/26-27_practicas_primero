<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include_once("./misFunciones.php");

//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
        "ADICIONAL" => ">>"
    ],
    [
        "TEXTO" => "Pruebas",
        "ENLACE" => "index.php"
    ],
    [
        "TEXTO" => "Ejemplos funciones"
    ]
];


$numero = doble(11);

!$numero ? $numero = 10 : $numero = doble($numero) === false ? exit : $numero;



//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $barra);
cuerpo($numero);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo(int $num)
{
?>
    <br><br>
    <main id="main">
        <br><br>

  
<?php
        echo $num;
}
?>
  </main>