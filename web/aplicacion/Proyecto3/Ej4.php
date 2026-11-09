<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

include_once("./libreria.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],

    [
        "TEXTO" => "Proyecto3",
        "ENLACE" => "/aplicacion/Proyecto3/index.php"
    ],
    [
        "TEXTO" => "Ej4",
        "ENLACE" => "/aplicacion/Proyecto3/Ej4.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej4");
cabecera();
finCabecera();
inicioCuerpo("Ej4", $barra);
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

        <?php //Ejercicio 4:

        echo "4.- Función devuelve(). Esta función recibe como parámetros tres números (enteros) y devuelve la
                suma de los tres valores en el primer parámetro y como resultado de la función el producto de los
                tres valores. Los dos últimos parámetros tendrán definidos valor por defecto (el que queráis).<br>
                Hacer varias llamadas a la función indicando:<br><br><br>";

        //Ejecucion de las funciones
        $num = 1;
        echo "- Los tres parámetros: " . devuelve($num, 2, 3) .
            "<br>- El primer parámetro únicamente: " . devuelve($num) .
            "<br>- El primer y el segundo parámetro: " . devuelve($num, 4) .
            "<br>- El primer y el tercer parámetro " . devuelve($num, num3: 1);


        ?>
    </main>
<?php
}
