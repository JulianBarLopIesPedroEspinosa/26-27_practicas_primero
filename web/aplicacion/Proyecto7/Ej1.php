<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],

    [
        "TEXTO" => "Proyecto7",
        "ENLACE" => "/aplicacion/Proyecto7/index.php"
    ],
    [
        "TEXTO" => "Ej1",
        "ENLACE" => "/aplicacion/Proyecto7/Ej1.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej1");
cabecera();
finCabecera();
inicioCuerpo("Ej1", $barra);
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
        <form method="post" action="index.php">
            <fieldset>
                <label for="x">Cordenada X</label>
                <input type="number"> <br>
                <label for="y">Cordenada Y</label>
                <input type="number">
                <select name="" id=""></select>
            </fieldset>
        </form>
        <?php //Ejercicio ¿:




        //Ejecucion de las funciones


        ?>
    </main>
<?php
}
