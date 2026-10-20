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
        "TEXTO" => "Ej2",
        "ENLACE" => "/aplicacion/Proyecto3/Ej2.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej2");
cabecera();
finCabecera();
inicioCuerpo("Ej2", $barra);
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

        <?php //Ejercicio 2:

        echo "2.- Función generarCadena(). A esta función se le pasa un parámetro con valor por defecto 10 y se
                encarga de devolver una cadena de longitud la indicada cuyos caracteres son generados de forma
                aleatoria (caracteres válidos: letras mayúsculas, minúsculas y números). Devolverá false si se ha
                indicado un número negativo o igual a 0.<br><br><br>
                
                Cadena con valor por defecto: ";
        //Ejecucion de las funciones
            echo generarCadena()."<br>Cadena de 2 char: ".generarCadena(2);
            

        ?>
    </main>
<?php
}
