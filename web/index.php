<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//Controlador

    $barra=[

        [
            "TEXTO"=> "inicio",
            "ENLACE"=>"index.php",
            "ADICIONAL"=>">>"
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
function cabecera() {

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
    <a href="./aplicacion/pruebas/index.php">Acceso a pruebas</a>
    </main>
<?php
}
