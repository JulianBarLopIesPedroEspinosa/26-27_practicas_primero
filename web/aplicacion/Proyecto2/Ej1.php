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
        "TEXTO" => "Proyecto2",
        "ENLACE" => "/aplicacion/Proyecto2/index.php"
    ],
    [
        "TEXTO" => "Ej1",
        "ENLACE" => "/aplicacion/Proyecto2/Ej1.php"
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

        <?php //Ejercicio 1:
        echo "1.- Escribe distintas cadenas usando “, ‘, HEREDOC y NOWDOC incluyendo variables, <br>
                etiquetas html y caracteres especiales como ‘, “, á, é, ñ. Muestra las cadenas y comprueba que  <br>
                el código fuente es legible (no se tiene una sola línea con todo seguido). Haz que se muestren  <br>
                las etiquetas html (no se ejecuten) <br><br>".PHP_EOL;

        $var1 = " Variable1 ";
        $var2 = " Variable2 ";
        
        echo "Esto es una cadena con \" \" y voy añadir \" tambien \' ;:á, é, ñ {$var1} y {$var2}<br>".PHP_EOL;
        echo 'Esto es una cadena con \' \' y voy añadir \" tambien \' ;:á, é, ñ '.$var1.' y '.$var2.' <br>'.PHP_EOL;

        echo <<<fin
        Esto es una cadena HEREDOC y voy añadir " tambien ' ;:á, é, ñ {$var1} y {$var2}<br>
        fin.PHP_EOL;

        echo <<<'fin'
        Esto es una cadena NOWDOC y voy añadir " tambien ' ;:á, é, ñ {$var1} y {$var2}<br>
        fin.PHP_EOL;
  
        ?>
    </main>
<?php
}
