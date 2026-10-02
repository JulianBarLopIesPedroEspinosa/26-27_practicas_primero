<?php
include_once(dirname(__FILE__) . "/../../../cabecera.php");
//dibuja la plantilla de la vista
inicioCabecera("Ej1 Libreria path");
cabecera();
finCabecera();
inicioCuerpo("Ej1 Libreria path");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {

    ?>
    <!-- esto va en el head -->
    <?php

}

//vista
function cuerpo()
{
?>
    <br><br>

<?php

    echo "1.- Mostrar el funcionamiento de diversas funciones Matemáticas (round,
            floor, pow, sqrt, entero a hexadecimal, de base 4 a base 8 y al menos
            dos funciones mas distintas de las anteriores)";

}
