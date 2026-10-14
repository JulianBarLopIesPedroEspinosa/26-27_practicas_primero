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
        "TEXTO" => "Proyecto2",
        "ENLACE" => "/aplicacion/Proyecto2/index.php"
    ],
    [
        "TEXTO" => "Ej1",
        "ENLACE" => "/aplicacion/Proyecto2/Ej1.php"
    ]
];


//dibuja la plantilla de la vista
inicioCabecera("Ej1");
cabecera();
finCabecera();
inicioCuerpo("Ej1", $barra);
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

        <?php //Ejercicio 1:

        echo "1.- Escribe distintas cadenas usando “, ‘, HEREDOC y NOWDOC incluyendo variables,<br>
                etiquetas html y caracteres especiales como ‘, “, á, é, ñ. Muestra las cadenas y comprueba que <br>
                el código fuente es legible (no se tiene una sola línea con todo seguido). Haz que se muestren <br>
                las etiquetas html (no se ejecuten) <br><br><br>";

        // Variables de prueba
        $nombre  = "María";
        $ciudad  = "Sevilla";
        $edad    = 25;

        // ─── 1. Comillas dobles ───────────────────────────────────────────
        // Variables SÍ se expanden. Las comillas " se escapan con \".
        $sd = "Hola, me llamo \"$nombre\". Vivo en $ciudad.
      Tengo $edad años y me gusta la 'programación'.
      <p>Esto es una etiqueta HTML.</p>
      <b>Caracteres: á, é, ñ</b>";

        // ─── 2. Comillas simples ──────────────────────────────────────────
        // Variables NO se expanden. Solo se reconocen \' y \\.
        $ss = 'Hola, me llamo \'María\'. Vivo en Sevilla.
      Tengo 25 años y me gusta la "programación".
      <p>Esto es una etiqueta HTML.</p>
      <b>Caracteres: á, é, ñ</b>';

        // ─── 3. HEREDOC ───────────────────────────────────────────────────
        // Se comporta como comillas dobles: variables SÍ se expanden.
        // No hay que escapar comillas ni simples ni dobles.
        $heredoc = <<<HTML
Hola, me llamo "$nombre". Vivo en $ciudad.
Tengo $edad años y me gusta la 'programación'.
<p>Esto es una etiqueta HTML.</p>
<b>Caracteres: á, é, ñ</b>
HTML;

        // ─── 4. NOWDOC ────────────────────────────────────────────────────
        // Se comporta como comillas simples: variables NO se expanden.
        // El identificador va entre comillas simples: <<<'IDENT'
        $nowdoc = <<<'HTML'
Hola, me llamo "$nombre". Vivo en $ciudad.
Tengo $edad años y me gusta la 'programación'.
<p>Esto es una etiqueta HTML.</p>
<b>Caracteres: á, é, ñ</b>
HTML;

        // ─── Mostrar resultados con etiquetas HTML visibles ───────────────
        // htmlspecialchars() convierte < > " ' en entidades,
        // así se ven las etiquetas y no se ejecutan.
        echo "<h2>1. Comillas dobles</h2>\n";
        echo htmlspecialchars($sd) . "\n<hr>\n";

        echo "<h2>2. Comillas simples</h2>\n";
        echo htmlspecialchars($ss) . "\n<hr>\n";

        echo "<h2>3. HEREDOC</h2>\n";
        echo htmlspecialchars($heredoc) . "\n<hr>\n";

        echo "<h2>4. NOWDOC</h2>\n";
        echo htmlspecialchars($nowdoc) . "\n";

        ?>
    </main>
<?php
}
