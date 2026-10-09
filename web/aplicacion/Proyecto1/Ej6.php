<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php",
    ],    
    [
        "TEXTO" =>"Menu",
        "ENLACE" =>"/aplicacion/pruebas/index.php"
    ],
    [
        "TEXTO" => "Proyecto1"
    ],
    [
        "TEXTO" => "Ej6",
        "ENLACE" => "/aplicacion/Proyecto1/Ej6.php"
    ]
];

$vector=array("primera" =>12.56, 24=>true, 67 =>23.76);

//dibuja la plantilla de la vista
inicioCabecera("Ej6");
cabecera();
finCabecera();
inicioCuerpo("Ej6", $barra);
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

        <?php //Ejercicio 6:
      
        echo '6.- Con el array $vector=array("primera" =>12.56, 24=>true, 67 =>23.76);<br>
                - Simular el funcionamiento de foreach ($array as $indice => $valor) 
                usando las funciones de recorrido para mostrar tanto los índices como
                los valores del array anterior.<br>
                - Simular el funcionamiento de foreach usando las funciones 
                    array_keys y array_values para mostrar tanto los índices como los valores del
                    array anterior.<br>
                El array se definirá en el controlador y se realizarán las operaciones en la vista.<br><br><br>';

                echo "Primera forma;";
                foreach($vector as $i => $elem){
                    echo "<br>Posicion $i => Valor $elem";
                }
                echo "<br><br>Segunda forma;";
                $i= array_keys($vector);
                $elem = array_values($vector);

                for($j=0;$j<count($vector);$j++){
                    echo "<br>Posicion ".$i[$j]." => Valor ".$elem[$j];
                }
        ?>
    </main>
<?php
}
