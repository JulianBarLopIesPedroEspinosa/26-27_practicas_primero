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
        "TEXTO" => "Ej5",
        "ENLACE" => "/aplicacion/Proyecto1/Ej5.php"
    ]
];

$vector = array();
$vector[1] = "esto es una cadena";
$vector["posi1"] = 25.67;
$vector[] = false;
$vector["ultima"] = array(2, 5, 96);
$vector[56] = 23;



//dibuja la plantilla de la vista
inicioCabecera("Ej5");
cabecera();
finCabecera();
inicioCuerpo("Ej5", $barra);
cuerpo($vector);  //llamo a la vista
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
function cuerpo(array $vector)
{
?>
    <main id="main">
        <br><br>

        <?php //Ejercicio 5:
        echo '5.- Rellenar un array con el siguiente contenido.<br>
                $vector=array();                    <br>
                $vector[1]="esto es una cadena";    <br>
                $vector["posi1"]=25.67;             <br>
                $vector[]=false;                    <br>
                $vector["ultima"]=array(2,5,96);    <br>
                $vector[56]=23;                     <br>
                Mostrar mediante bucles foreach el contenido del array con la siguiente salida:<br>
                - posicion XXX contenido (tipo) YYYYY                                   <br>
                - Según el tipo del contenido                                           <br>
                o Si es un array mostrarlo mediante un foreach.                         <br>
                o Si es un entero poner Entero con valor DDD, en binario BBB            <br>
                o Si es un real DDD que al cuadrado es DDD                              <br>
                o Si es una cadena -CCCCo Si es un booleano BBB y su opuesto XXX        <br>
                Las palabras en mayúscula representan un valor concreto de lo pedido    <br>
                El array se definirá en el controlador y se visualizará en la vista     <br><br><br>';


                foreach($vector as $i=> $elem){
                    echo "<br>posicion $i contenido ";
                    if(is_array($elem)){
                        echo "(array); ";
                        foreach($elem as $j){
                            echo $j." ";  
                        }
                    }
                    else if (is_int($elem)){
                        echo "(entero); Entero con valor $elem, en binario ".decbin($elem);
                    }
                    else if(is_float($elem)){
                        echo "(real); $elem que al cuadrado es ".pow($elem,2);
                    }
                    else if(is_string($elem)){
                        echo "(cadena); $elem";
                    }
                    else if(is_bool($elem)){//Aqui hay una condicional porque sino no se muestran los booleanos
                        echo "(boolean);".(($elem)?"true":"false").", y su opuesto ".((!$elem)?"true":"false");
                    };
                };

        ?>
    </main>
<?php
}
