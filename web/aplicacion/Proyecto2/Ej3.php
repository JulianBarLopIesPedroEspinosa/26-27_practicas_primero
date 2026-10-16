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
        "TEXTO" => "Ej3",
        "ENLACE" => "/aplicacion/Proyecto2/Ej3.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej3");
cabecera();
finCabecera();
inicioCuerpo("Ej3", $barra);
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

        <?php //Ejercicio 3:

        echo "3.- Genera una cadena aleatoria de 20 caracteres (los caracteres permitidos son letras 
                    minúsculas, letras mayúsculas y números) <br>
                    a) A partir de un array en el que están todos los caracteres posibles que cumplen la 
                    condición. (tienes que rellenar el array con todos los caracteres validos) <br>
                    b) A partir del código ASCII (se puede indicar un rango mayor y eliminar aquellos 
                    caracteres que no lo cumplan). <br>";

        $permitidos = array();

        // Minúsculas
        foreach (range('a', 'z') as $c) {
            $permitidos[] = $c;
        }
        // Mayúsculas
        foreach (range('A', 'Z') as $c) {
            $permitidos[] = $c;
        }
        // Números
        foreach (range(0, 9) as $c) {
            $permitidos[] = (string)$c;
        }

        //Uso un metodo range que me da todo lo que hay de un rango a otro
        echo "<br>Cadena aleatoria con arrays: ";

        $aleatoria = "";
        for ($i = 0; $i < 20; $i++) {
            $aleatoria += $permitidos[random_int(0, (count($permitidos) - 1))];
        }
        echo $aleatoria;

        ?>
    </main>
<?php
}
