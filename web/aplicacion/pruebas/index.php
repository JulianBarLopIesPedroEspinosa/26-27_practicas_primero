<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
    $barra=[

        [
            "TEXTO"=> "inicio",
            "ENLACE"=>"index.php",
            "ADICIONAL"=>">>"
            ],
        [
            "TEXTO"=>"Pruebas"
        ],   
        [
            "TEXTO"=>"index",
            "ENLACE" => "./aplicacion/pruebas/index.php"
            ]
        ];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION",$barra);
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
    <a href="basicas.php">Funcionamiento basico</a>   <br>
    <a href="pasopar.php">Paso parametros</a>   <br>
    <a href="../Proyecto1/Ej1.php">Ej1 </a>   <br>
    <a href="../Proyecto1/Ej2.php">Ej2 </a>   <br>

    </main>
<?php
}
