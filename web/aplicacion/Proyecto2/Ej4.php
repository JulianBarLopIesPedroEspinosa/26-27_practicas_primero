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
        "TEXTO" => "Ej4",
        "ENLACE" => "/aplicacion/Proyecto2/Ej4.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej4");
cabecera();
finCabecera();
inicioCuerpo("Ej4", $barra);
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

        <?php //Ejercicio 4:
        echo '4.- Tengo unas variables con valores 17.5 (float), 379987.24 (float) <br>
                Mostrarlas de forma que resulte "el primer valor -0000000000017,5-, el segundo valor -
                379.987,24-" (usar number format para obtener el formateo de los números, los números se
                muestran con 15 caracteres en total, el primero relleno con 0 y el segundo con espacios-debe
                aparecer el espacio))<br><br><br>';



        $valor1 = 17.5;
        $valor2 = 379987.24;

        // Primer valor: 15 caracteres, rellenando con ceros
        $numero1 = number_format($valor1, 1, ',', '');
        $numero1 = str_pad($numero1, 15, '0', STR_PAD_LEFT); //Uso str_pad para poder rellenar hasta alcanzar el formato deseado

        // Segundo valor: 15 caracteres, rellenando con espacios
        $numero2 = number_format($valor2, 2, ',', '.');
        $numero2 = str_pad($numero2, 15, ' ', STR_PAD_LEFT);

        //Para poder mostrar los espacios tengo que usar este metodo porque sino el metodo str_pad no los muestra ni aunque usemos &nbsp
        echo "El primer valor -$numero1-, el segundo valor -" . str_replace(' ', '&nbsp', $numero2) . "-";


        ?>
    </main>
<?php
}
