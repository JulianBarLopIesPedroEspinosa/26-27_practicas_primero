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
        "TEXTO" => "Ej?",
        "ENLACE" => "/aplicacion/Proyecto1/Ej3.php"
    ]
];

//Primer array
$myArray = [];

//Array con una sola sentencia
$myArray1 = array();

//Array con una sola sentencia
$myArray2 = [];

//Array donde se guardan los demas
$superArray = [&$myArray,&$myArray1,&$myArray2];

//dibuja la plantilla de la vista
inicioCabecera("Ej3");
cabecera();
finCabecera();
inicioCuerpo("Ej3", $barra);
cuerpo($superArray, $myArray, $myArray1, $myArray2,);  //llamo a la vista
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
function cuerpo(array &$superArray,array &$myArray, array &$myArray1, array &$myArray2)
{
?>
    <main id="main">
        <br><br>

        <?php //Ejercicio 3:

        echo "<br> 3.- Se quiere:<br>
                a) Crear una variable de tipo array.<br>
                b) Rellenar las posiciones 1, 16, 54 con valores cualquiera.<br>
                c) Añadir el valor 34 al final<br>
                d) Añadir los valores “cadena”, true, 1.345 en las posiciones “uno”, “dos” y “tres”<br>
                e) Rellenar la posición “ultima” con el array (1,34,”nueva”);<br>
                - Hacer lo anterior creando y rellenando el array usando varias sentencias.<br>
                - Hacer lo anterior usando una sola sentencia con array;<br>
                - Hacer lo anterior usando una sola sentencia con []<br>
                - Recorrer los tres arrays usando foreach mostrando todos los valores de los arrays creados<br>
                Los arrays se definirán en el controlador y se visualizarán en la vista.<br><br><br><br>";
        //Damos los valores al primer array
        $myArray[1] = 1;
        $myArray[16] = 16;
        $myArray[54] = 54;
        $myArray[] = 34;
        $myArray["uno"] = "cadena";
        $myArray["dos"] = true;
        $myArray["tres"] = 1.345;
        $myArray["ultima"] = [1, 34, "nueva"];
        
        //Damos los valores al segundo array    
        $myArray1 = array(
            1 => 1,
            16 => 16,
            54 => 54,
            34,
            "uno" => "cadena",
            "dos" => true,
            "tres" => 1.345,
            "ultima" => [1, 34, "nueva"]
        );

        //Damos los valores al tercer array
        $myArray2 = [
            1 => 1,
            16 => 16,
            54 => 54,
            34,
            "uno" => "cadena",
            "dos" => true,
            "tres" => 1.345,
            "ultima" => [1, 34, "nueva"]
        ];

        //Mostrar el primer array
        foreach($superArray as $array){
                foreach ($array as $elem) {
                if (is_array($elem))
                    print_r($elem);
                else
                    echo $elem."<br>";
            };
            echo "<br><br>";
        };


        ?>
    </main>
<?php
}
