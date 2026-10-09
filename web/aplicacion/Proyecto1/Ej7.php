<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    [
        "TEXTO" => "Menu",
        "ENLACE" => "/aplicacion/pruebas/index.php"
    ],
    [
        "TEXTO" => "Proyecto1"
    ],
    [
        "TEXTO" => "Ej7",
        "ENLACE" => "/aplicacion/Proyecto1/Ej7.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej7");
cabecera();
finCabecera();
inicioCuerpo("Ej7", $barra);
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

        <?php //Ejercicio 7:

       echo "7.- Mostrar el funcionamiento de las fechas. Se harán todos los apartados usando la serie de funciones
            para gestión de fecha. Se repetirán todos los ejercicios usando la clase DateTime.
            - Mostrar la fecha actual en el formato “d/m/Y”
            - Mostrar la fecha actual en el formato “dia d, mes mmmm, año yyyy, dia de la semana dd”.
            - Mostrar la hora actual en el formato “hh:mm:ss”
            - Mostrar los tres apartados anteriores para la fecha 29/3/2024 a 12:45.
            - Mostrar los tres apartados anteriores para la fecha actual menos 12 días y 4 horas
            Se definirán las fechas y se visualizarán directamente en la vista. ( no se definirán en el
            controlador)";


        //Ejecucion de las funciones


        ?>
    </main>
<?php
}
