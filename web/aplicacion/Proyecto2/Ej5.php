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
        "TEXTO" => "Ej5",
        "ENLACE" => "/aplicacion/Proyecto2/Ej5.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej5");
cabecera();
finCabecera();
inicioCuerpo("Ej5", $barra);
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

        <?php //Ejercicio 5:
        echo "5.- Crea una cadena que ocupe varias líneas (usa nowdoc o heredoc). En líneas distintas debe
            aparecer: varias etiquetas html (<>), varios números (de 1 o varias cifras) y varias direcciones
            de correo electrónico (formato aaaa@aaaa.aa).
            Define expresiones regulares apropiadas para localizar los distintos elementos creados
            (etiqueta, numero y dirección de email) en la cadena.
            Muestra la posición/elemento encontrado usando las expresiones regulares definidas y la
            función preg_match <br><br><br>";





        $cadena = <<<fin
                Etiquetas HTML: <html> <body> <h1> <p>
                Números: 7 25 198 3456
                Correos: juan@gmail.com ana123@gmail.com pepe@gmail.com
                fin;

        // Expresiones regulares
        $patronEtiqueta = '/<[^>]+>/'; //Etiquetas entre < y >
        $patronNumero = '/\b\d+\b/'; //Números de una o varias cifras
        $patronEmail = '/\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\b/'; //Direcciones de correo electrónico

        // Buscar todas las etiquetas
        preg_match_all($patronEtiqueta, $cadena, $coincidencias, PREG_OFFSET_CAPTURE);

        foreach ($coincidencias[0] as $coincidencia) {
            echo "Etiqueta: " . htmlspecialchars($coincidencia[0]) . " - Posición: " . $coincidencia[1] . "<br>";
        }
        echo "<br>";

        // Buscar todos los números
        preg_match_all($patronNumero, $cadena, $coincidencias, PREG_OFFSET_CAPTURE);

        foreach ($coincidencias[0] as $coincidencia) {
            echo "Número: " . $coincidencia[0] . " - Posición: " . $coincidencia[1] . "<br>";
        }
        echo "<br>";

        // Buscar todos los correos
        preg_match_all($patronEmail, $cadena, $coincidencias, PREG_OFFSET_CAPTURE);

        foreach ($coincidencias[0] as $coincidencia) {
            echo "Email: " . htmlspecialchars($coincidencia[0]) . " - Posición: " . $coincidencia[1] . "<br>";
        }

        ?>
    </main>
<?php
}
