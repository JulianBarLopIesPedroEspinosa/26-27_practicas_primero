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
        "TEXTO" => "Ej1",
        "ENLACE" => "/aplicacion/Proyecto3/Ej1.php"
    ]
];

$miArray = [];
$miCadena = "";
$miNumero = 0;
$contador = 0;

//Bucle que llamara a la funcion 10 veces y me ira rellenando el array con "pos0, pos1 ..., y en cada posicion sera el valor 0, 1 ...
for ($i = 0; $i < 10; $i++) {
    $miCadena = "pos" . $i;
    cuentaVeces($miArray, $miCadena, $i, $contador);
}

//dibuja la plantilla de la vista
inicioCabecera("Ej1");
cabecera();
finCabecera();
inicioCuerpo("Ej1", $barra);
cuerpo($miArray);  //llamo a la vista
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
function cuerpo(array $miArray)
{
?>
    <main id="main">
        <br><br>

        <?php //Ejercicio 1:

        echo " 1.- Función cuentaVeces(). A esta función se le pasan cuatro parámetros: un array, una cadena y dos
        números. La función se encargará de añadir en el array el primer número a la posición asociativa
        indicada por la cadena. Hay que tener en cuenta que el array debe quedar actualizado cuando se
        salga de la función. Además, cada vez que se llama a la función, se devuelve en el segundo número
        un valor que corresponde con el número de llamada actual (1 para la primera, 2 para la segunda
        llamada, etc). Se devolverá true si todo ha ido bien y false si se ha detectado algún error. (se debe
        dar error si se indica como posición“2daw”o “primera”)<br><br><br>
        
        Mostrar lo que devuelve las 10 llamadas a la funcion:<br>";

        foreach ($miArray as $i => $elem) {
            echo $i . " => " . $elem . "<br>";
        };



        ?>
    </main>
<?php
}
