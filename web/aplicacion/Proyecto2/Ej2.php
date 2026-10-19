<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],
    
    [
        "TEXTO" => "Proyecto2",
        "ENLACE" => "/aplicacion/Proyecto2/index.php"
    ],
    [
        "TEXTO" => "Ej2",
        "ENLACE" => "/aplicacion/Proyecto2/Ej2.php"
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

        $cadena = "Está la niña en casa";
        //Aqui recorremos la cadaena byte a byte pero como estamos en UTF-8 algunas caracteres son 2 Bytes 
        for ($i = 0; $i < strlen($cadena); $i++) {
            for ($j = 0; $j < $i; $j++) {
                echo "&nbsp";
            };
            echo $cadena[$i] . "<br>";
        };

        for ($i = 0; $i < strlen($cadena); $i++) {
            echo str_repeat("&nbsp", $i) . substr($cadena, $i, 1) . "<br>" . PHP_EOL;
        };

        //Esta es la unica de las tres que trata los multiBytes
        for ($i = 0; $i < strlen($cadena); $i++) {
            echo str_repeat("&nbsp", $i) . mb_substr($cadena, $i, 1) . "<br>" . PHP_EOL;
        };

        //Mostrar al reves
        for ($i = strlen($cadena) - 1; $i >= 0; $i--) {
            if ($i % 2 == 0) {
                echo str_repeat("&nbsp", $i) . mb_strtoupper(mb_substr($cadena, $i, 1)) . "<br>" . PHP_EOL;
            } else {
                echo str_repeat("&nbsp", $i) . mb_strtolower(mb_substr($cadena, $i, 1)) . "<br>" . PHP_EOL;
            }
        };

        //Hacer saltos de linea en la a
        $partes = explode("a", $cadena);

        foreach ($partes as $parte) {
            echo "<br>" . $parte . PHP_EOL;
        }

        //Localiza en la cadena la palabra niña y cambia el siguiente carácter a niña (el espacio en blanco) por "/mujer "

        mb_strpos($cadena,"niña"); //8

        $cadena = mb_substr($cadena,0,(mb_strpos($cadena,"niña") + 4)) . "/mujer " 
                   . mb_substr($cadena,(mb_strpos($cadena,"niña") + 5),strlen($cadena));

        echo $cadena;

        ?>
    </main>
<?php
}
