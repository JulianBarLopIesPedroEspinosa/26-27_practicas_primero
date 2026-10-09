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
        "TEXTO" => "Ej4",
        "ENLACE" => "/aplicacion/Proyecto1/Ej4.php"
    ]
];
//Creo el array 
$myArray = [];

//Creo la constante
const FILAS = 7;

//Voy a crear una funcion donde le mando como parametro un numero
    // y la variable del array que va por referencia
function piramide(int $num, array &$myArray)
{

    for ($i = 0; $i < $num; $i++) {
        for ($j = 0; $j <= $i; $j++) {
            $myArray[$i][$j] = $i + 1;
        };
    };
};



//dibuja la plantilla de la vista
inicioCabecera("Ej4");
cabecera();
finCabecera();
inicioCuerpo("Ej4", $barra);
cuerpo($myArray);  //llamo a la vista
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
function cuerpo(array $myArray)
{
?>
    <main id="main">
        <br><br>

        <?php //Ejercicio 4:

        echo "4- Generar un array con los siguientes valores mostrándolos posteriormente con foreach.
           El array se debe generar usando bucles for.<br>
            1<br>
            2 2<br>
            3 3 3<br>
            4 4 4 4<br>
            5 5 5 5 5<br>
            Declarar la constante FILAS que se rellenará con el número de filas que se deben crear.
            Repetir lo anterior usando FILAS para crear el array y visualizarlo.
            Los datos se definirán en el controlador y se visualizarán en la vista<br><br><br>";

        function mostrarArray(array $myArray)
        {
            foreach ($myArray as $elem) {
                foreach ($elem as $j) {
                    echo "&nbsp$j";
                };
                echo "<br>";
            };
        };
        //Ejecucion de las funciones
        piramide(5, $myArray);
        mostrarArray($myArray);

        echo "<br>";

        //Ahora ejecutarla con la constante
        piramide(FILAS, $myArray);
        mostrarArray($myArray);

        ?>
    </main>
<?php
}
