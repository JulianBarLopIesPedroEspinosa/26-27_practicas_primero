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
        "TEXTO" => "Ej3",
        "ENLACE" => "/aplicacion/Proyecto2/Ej3.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej3");
cabecera();
finCabecera();
inicioCuerpo("Ej3", $barra);
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

        <?php //Ejercicio 3:

        echo "3.- Genera una cadena aleatoria de 20 caracteres (los caracteres permitidos son letras 
                    minúsculas, letras mayúsculas y números) <br>
                    a) A partir de un array en el que están todos los caracteres posibles que cumplen la 
                    condición. (tienes que rellenar el array con todos los caracteres validos) <br>
                    b) A partir del código ASCII (se puede indicar un rango mayor y eliminar aquellos 
                    caracteres que no lo cumplan). <br>";


        //Primera forma, creo un array y lo reyeno usando el metodo range, al principio lo iba a rellenar manualmente
        // pero encontre que sepodia hacer de esa forma mejor, luego hago un bucle de que da 2o vueltas y en cada una 
        // elige una posicion aleatoria del array y lo va concatenando en mi variable cadena

        $permitidos = array();

        $caracteres = mb_str_split("qwertyuioplkjhgfdsazxcvbnmMNBVCXZLKJHGFDSAQWERTYUIOP1234567890"); //Otra forma mejor y menos IA
    
        // Minúsculas
        foreach (range('a', 'z') as $c) {
            $permitidos[] = $c;
        }
        // Mayúsculas
        foreach (range('A', 'Z') as $c) {
            $permitidos[] = $c;
        }
        // Números
        foreach (range(0, 9) as $c) {
            $permitidos[] = (string)$c;
        }

        echo "<br>Cadena aleatoria con arrays: ";

        $aleatoria = "";
        for ($i = 0; $i < 20; $i++) {
            $aleatoria .= $permitidos[rand(0, (count($permitidos) - 1))];
        }
        echo $aleatoria;

        //Segunda forma, Aqui hago un bucle que me genere los numeros aleatorios delimitados por el codigo ascii
        // creo una funcion que me devolvera los valores del codigo ASCII que esten permitidos por el enunciado

        function permitidos()
        {
            $num = 0;
            $sw = true;
            while ($sw) {
                $num = rand(48, 122);
                if ($num < 58 || ($num > 64 && $num < 91) || $num > 96) {
                    $sw = false;
                }
            };
            return chr($num);
        };

        $cadena = "";
        for ($i = 0; $i < 20; $i++) {
            $cadena .= permitidos();
        }
        echo "<br><br>Segunda parte, cadena aleatoria mediante ASCII: " . $cadena;

        ?>
    </main>
<?php
}
