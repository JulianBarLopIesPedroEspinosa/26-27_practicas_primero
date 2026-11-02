<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//Controlador
$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Relación 4",
        "ENLACE" => "/aplicacion/relacion4/index.php"
    ]
];

//Ejercicio 1 y 3: instrumento de viento (InstrumentoBase es abstracta, se prueba con su hija)
$viento = new InstrumentoViento("metal", 20);
$viento->envejecer();

//Ejercicio 2 y 4: flauta creada con el constructor estatico y su clon
$flauta = Flauta::CrearDesdeArray(["material" => "plata", "edad" => 3]);
$clon = clone $flauta;

//Ejercicio 5: persona con un estado civil aleatorio
$valores = [];
foreach (EstadoCivil::casos() as $caso)
    $valores[] = $caso->valor();

$estado = EstadoCivil::from($valores[rand(0, count($valores) - 1)]);
$persona = Persona::registrarPersona("Lucía", "15/03/2001", "calle Real 4", "Málaga", $estado);

//Ejercicio 6: serie de Fibonacci
$serie = new SerieFibonacci(10);

//Ejercicio 7: propiedades dinamicas
$objeto = new ClaseMisPropiedades();
$objeto->propPublica = "publica";
$objeto->propiedad1 = 25;
$objeto->propiedad2 = "cadena de texto";


//dibuja la plantilla de la vista
inicioCabecera("Relación 4");
cabecera();
finCabecera();
inicioCuerpo("Relación 4", $barra);
cuerpo($viento, $flauta, $clon, $persona, $serie, $objeto);  //llamo a la vista
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
function cuerpo(
    InstrumentoViento $viento,
    Flauta $flauta,
    Flauta $clon,
    Persona $persona,
    SerieFibonacci $serie,
    ClaseMisPropiedades $objeto
) {
?>
    <main id="main">

        <h2>1.- InstrumentoBase y 3.- InstrumentoViento</h2>
        <p class="enunciado">Clase abstracta InstrumentoBase con descripción, edad, contador de instancias,
            envejecer() y los métodos abstractos sonido() y afinar(). InstrumentoViento hereda de ella
            y añade el material.</p>
        <div class="resultado">
            <p><?= $viento ?></p>
            <p>Sonido: <?= $viento->sonido() ?></p>
            <p>Afinar: <?= $viento->afinar() ?></p>
        </div>

        <h2>2.- IFabricable y 4.- Flauta</h2>
        <p class="enunciado">Flauta es un instrumento de viento fabricable, con constructor privado,
            constructor estático CrearDesdeArray() y clonación con edad 0.</p>
        <div class="resultado">
            <p><?= $flauta ?></p>
            <p>Fabricación: <?= $flauta->metodoFabricacion() ?></p>
            <p>Reciclado: <?= $flauta->metodoReciclado() ?></p>
            <p>Clon: <?= $clon ?></p>
        </div>

        <h2>5.- EstadoCivil y Persona</h2>
        <p class="enunciado">Enumeración EstadoCivil y clase Persona creada con registrarPersona()
            y un estado civil aleatorio.</p>
        <div class="resultado">
            <p><?= $persona ?></p>
        </div>

        <h2>6.- SerieFibonacci</h2>
        <p class="enunciado">Serie de Fibonacci con la interfaz Iterator y con un generador.</p>
        <div class="resultado">
            <p>Con Iterator:
                <?php
                foreach ($serie as $valor)
                    echo "$valor &nbsp;";
                ?>
            </p>
            <p>Con generador:
                <?php
                foreach (SerieFibonacci::fFibonacci(10) as $valor)
                    echo "$valor &nbsp;";
                ?>
            </p>
        </div>

        <h2>7.- ClaseMisPropiedades</h2>
        <p class="enunciado">Clase con propiedades dinámicas que se puede recorrer con foreach.</p>
        <div class="resultado">
            <?php
            foreach ($objeto as $clave => $valor)
                echo "$clave = $valor<br>";
            ?>
        </div>

    </main>
<?php
}