<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Controlador
$barra = [

    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" =>"Menu",
        "ENLACE" =>"/aplicacion/pruebas/index.php"
    ],
    [
        "TEXTO" => "Proyecto1"
    ],
    [
        "TEXTO" => "Ej2",
        "ENLACE" => "/aplicacion/Proyecto1/Ej2.php"
    ]
];

define("LANZAMIENTOS", 1000); //Definimos la constante

$lanzamientos = []; //Array donde guardaremos las tiradas

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
        echo "2.- Simular el lanzamiento de un dado (6 veces) (usar un bucle for, 
            mt_rand con parametros). Además contar el número de veces que aparece cada lado
            si se hicieran N lanzamientos al estilo (N lo definiremos como constante) 
            (usar un bucle while, mt_rand sin parametros). Se deben usar arrays para 
            almacenar los datos de las tiradas. Los arrays deben obtenerse en la parte del
            controlador y visualizarse los resultados en la vista. Los arrays se pasarán como
            parámetros a la vista (nunca como variables globales)<br><br><br>";


        //Lanzar el dado el numero de veces indicadas y mostrar el resultado de cada tirada
        function lanzar(int $num)
        {
            for ($i = 1; $i <= $num; $i++) {
                echo "Lanzamiento " . $i . " del dado: " . floor(mt_rand(1, 6)) . "<br>";
            };
        };

        // Funcion donde cada tirada que hace la guarda en un array y luego muestra la cantida de veces 
            // que ha salido cada cara, para ello usamos un switch que aumenta en uno el valor de la posicion
            // del array correspondiente a la cara
        function lanzamientosArray(int $num)
        {
            $lanzamientos = [0, 0, 0, 0, 0, 0]; //Inicializamos el array cada vez que hacemos la llamada y evitamos errores
            $i = 0; //Asignamos el contador
            while ($i < $num) {
                switch (floor(mt_rand() % 6) + 1) {
                    case 1:
                        $lanzamientos[0] += 1;
                        break;
                    case 2:
                        $lanzamientos[1] += 1;
                        break;
                    case 3:
                        $lanzamientos[2] += 1;
                        break;
                    case 4:
                        $lanzamientos[3] += 1;
                        break;
                    case 5:
                        $lanzamientos[4] += 1;
                        break;
                    case 6:
                        $lanzamientos[5] += 1;
                        break;
                } //Fin switch
                $i++; //Aumentamos el contador
            }; //fin while
 
            //Mostramos los resultados
            echo "<br>Se ha lanzado el dado " . $num . " veces.<br>";

            foreach ($lanzamientos as $i => $elem) {
                echo "el ".($i+1)." ha salido ".$elem." con un porcentaje de ".(($elem / $num)*100)."%<br>";
            };
        };



        //Ejecucion de las funciones
        lanzar(6);

        lanzamientosArray(LANZAMIENTOS);

        ?>
    </main>
<?php
}
