<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

// ********************************************************************
// CONTROLADOR
// ********************************************************************

// Barra de ubicación
$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Proyecto 4",
        "ENLACE" => "/aplicacion/Proyecto4/index.php"
    ]
];

// Enunciados de la relación
// Cada ejercicio tiene: titulo, intro (texto inicial), puntos (lista) y,
// opcionalmente, codigo (ejemplo que se muestra tal cual) y final (texto después de la lista)
$enunciados = [
    1 => [
        "titulo" => "Clase abstracta InstrumentoBase",
        "intro" => "Crear la clase abstracta InstrumentoBase con el siguiente comportamiento. Definirla
                    inicialmente como no abstracta para probar su funcionamiento. Una vez probado se pasará a abstracta:",
        "puntos" => [
            "Tiene el atributo <strong>descripción</strong> de tipo cadena. La descripción se puede fijar mediante el
             constructor o mediante métodos get/set públicos (ej. para propiedad cadena, métodos getCadena/setCadena,
             no confundir con lo que veremos después como método mágico __get y __set). Directamente no puede ser accesible.",
            "Tiene el atributo <strong>edad</strong> que no es accesible desde el exterior aunque sí desde las clases
             descendientes. Su valor por defecto será 10. Se tiene método get para devolver su valor. Se asignará en el
             constructor. Para definir los atributos con valor por defecto se declaran en la clase, con el valor por
             defecto, se define un parámetro en el constructor con el valor por defecto y se asigna en el constructor.
             Así garantizas que cuando se llame al constructor, si no se indica ningún valor, se asigne el de por defecto.",
            "Se definen dos métodos abstractos: <strong>sonido</strong> (devuelve una frase que representa el sonido) y
             <strong>afinar</strong> (devuelve una cadena con los pasos necesarios para afinar el instrumento).",
            "Se define el método <strong>envejecer</strong>, que aumenta la edad del instrumento en un año.",
            "Se tiene una variable de clase protegida que controla cuántos elementos se han creado y una propiedad de
             instancia para indicar cuál es el orden de creación de la instancia. Cada vez que se crea un instrumento se
             le asigna a la instancia el número de orden de creación del instrumento actual y se incrementa el valor de
             la variable de clase.",
            "Cuando se muestre en un echo aparecerá <em>“instrumento con descripción XXXXX, instancia 9999 de un total
             de 999. Tiene 999 años. La clase es XXXX”</em>. La clase debe ser obtenida mediante get_class.
             (999 representa un número, XXX representa una cadena)",
            "No tiene la sobrecarga de propiedades por defecto."
        ]
    ],
    2 => [
        "titulo" => "Interfaz IFabricable",
        "intro" => "Se tiene la interfaz IFabricable que permite indicar el proceso de fabricación y cómo se recicla.
                    Esta interfaz establece los métodos:",
        "puntos" => [
            "<strong>metodoFabricacion</strong>: devuelve los pasos para fabricar el elemento.",
            "<strong>metodoReciclado</strong>: devuelve el método de reciclado que se debe aplicar al elemento según su fabricación."
        ]
    ],
    3 => [
        "titulo" => "Clase InstrumentoViento",
        "intro" => "Definir la clase InstrumentoViento que hereda de InstrumentoBase con el siguiente comportamiento:",
        "puntos" => [
            "La descripción es “instrumento de viento”.",
            "Tiene el atributo <strong>material</strong> con valor por defecto madera. Este atributo no es accesible
             directamente desde el exterior aunque sí desde las clases derivadas. No se tienen métodos set/get para esta propiedad.",
            "Al constructor se le pasa como parámetro el material y la edad (valor por defecto 15).",
            "El método afinar no debe ser redefinible en las clases derivadas de esta.",
            "Cuando se muestre en un echo aparecerá, junto a todo lo indicado por la clase base, el texto
             <em>“Instrumento de material XXXX”</em>."
        ]
    ],
    4 => [
        "titulo" => "Clase Flauta",
        "intro" => "Definir la clase Flauta que es un instrumento de viento que es fabricable y de la que no se puede
                    heredar ninguna otra subclase.",
        "puntos" => [
            "El constructor se hará privado.",
            "Se tiene el método estático <strong>CrearDesdeArray</strong> (constructor estático) con parámetro un array
             con posiciones asociativas “material” y “edad” (pueden no aparecer, por lo que se tienen en cuenta valores
             por defecto) y que devuelve una instancia de Flauta con los valores indicados.",
            "Definir el método de clonación para la clase Flauta de forma que el nuevo objeto tenga los mismos valores,
             salvo la edad que será 0 y el número de instancia (propiedad) / número de instancias (propiedad de clase),
             ya que realmente he creado una nueva instancia."
        ]
    ],
    5 => [
        "titulo" => "Enumeración EstadoCivil y clase Persona",
        "intro" => "Definir el tipo enumerado <strong>EstadoCivil</strong> con las siguientes características:",
        "puntos" => [
            "Casos de soltero, casado, pareja y viudo con valores 10, 20, 30 y 40 respectivamente.",
            "Método <strong>descripcion</strong> que devuelve el nombre del caso concreto.",
            "Método <strong>valor</strong> que devuelve el valor del caso concreto.",
            "Método estático <strong>casos</strong> que devuelve un array con todos los casos."
        ],
        "intro2" => "Definir la clase <strong>Persona</strong> que tendrá:",
        "puntos2" => [
            "Propiedades nombre (string), fecha_nacimiento (string), domicilio (string), localidad (string) y estado
             (EstadoCivil). Todas las propiedades son privadas.",
            "Un conjunto de sentencias get/set para devolver/poner su valor.",
            "Constructor privado al que no se indica ningún parámetro y que rellena las propiedades con valores nombre
             “prueba”, fecha_nacimiento “01/01/2000”, domicilio “carrera 12”, localidad “antequera” y estado “soltero”.",
            "Constructor estático <strong>registrarPersona</strong>, que recibe parámetros para todas las propiedades.",
            "Método <strong>toString</strong> que devuelve la cadena <em>“Nombre es una persona estado nacida en
             fecha_nacimiento y que vive en localidad”</em>."
        ],
        "final" => "Probar la clase creando una persona y asignando un estado a partir de un valor aleatorio de entre
                    los valores posibles que obtendremos del EstadoCivil."
    ],
    6 => [
        "titulo" => "Clase SerieFibonacci",
        "intro" => "Crear la clase SerieFibonacci que implementa la serie de Fibonacci. Esta serie se basa en la fórmula
                    F(x) = F(x-1) + F(x-2) siendo F(0) = 0 y F(1) = 1. Para obtener el valor F(n) se puede usar la
                    fórmula alternativa (fórmula de Binet): F(n) = (φ<sup>n</sup> − (1 − φ)<sup>n</sup>) / √5,
                    con φ = (1 + √5) / 2.",
        "puntos" => [
            "Para implementar esta clase podéis usar la interfaz <strong>Iterator</strong> y tener dos propiedades
             privadas \$_limite y \$_claveActual. \$_limite indica hasta qué valor se generaría la serie.
             \$_claveActual indica cuál es el elemento actual para el que se calcula la serie.",
            "Crear la función <strong>fFibonacci(\$ultimo)</strong> como función estática dentro de la clase
             SerieFibonacci, que debe implementar la serie de Fibonacci usando para ello un generador."
        ],
        "codigo" => 'foreach (new SerieFibonacci(10) as $valor)
{
    echo "$valor &nbsp;";
}
/* Generaría 10 valores
   0 1 1 2 3 5 8 13 21 34 55
*/'
    ],
    7 => [
        "titulo" => "Clase ClaseMisPropiedades",
        "intro" => "Crear la clase ClaseMisPropiedades. En esta clase se define una propiedad privada llamada
                    \$_propiedades. Se debe permitir añadir en tiempo de ejecución cualquier nueva propiedad
                    (propiedades dinámicas) a una instancia.",
        "puntos" => [
            "Además tenemos las propiedades de instancia \$propPublica (pública, mixed) y \$_propPrivada (privada,
             mixed, inicializada a 25).",
            "Se debe garantizar que no se pueda asignar un valor a una propiedad que llamemos _propPrivada
             (creada de forma dinámica).",
            "La clase debe ser <strong>iterable</strong>. Así, cuando se haga un foreach (\$Objeto as \$clave => \$valor)
             se deben devolver como claves las propiedades con el prefijo <strong>oi_</strong> delante (ejemplo: para la
             propiedad propiedad1 se devolverá como clave oi_propiedad1), incluyendo propPublica y _propPrivada como
             últimos elementos a devolver en el foreach."
        ],
        "codigo" => '$Objeto = new ClaseMisPropiedades();
$Objeto->propPublica = "publica";
//$Objeto->_propPrivada = "privada"; // no es válida al ser privada
$Objeto->propiedad1 = 25;
$Objeto->propiedad2 = "cadena de texto";
echo "la propiedad 1 vale " . $Objeto->propiedad1 . "<br>";
// echo $Objeto->propiedad3; // esto debería dar un error al no
//                           // haber asignado previamente la propiedad'
    ]
];

// ********************************************************************
// VARIABLES PARA PROBAR LAS CLASES (controlador)
// Los errores se capturan aquí y se guarda el mensaje para mostrarlo en la vista
// ********************************************************************

// ---------- Ejercicio 1: InstrumentoBase ----------
// Al ser abstracta no se puede instanciar: lo comprobamos
try {
    $instrumentoBase = new InstrumentoBase("prueba");
    $errorAbstracta = "";
} catch (Error $e) {
    $errorAbstracta = $e->getMessage();
}

// Se prueba su comportamiento a través de una clase hija
$instrumento1 = new InstrumentoViento();
$descripcionInicial = $instrumento1->getDescripcion();
$edadInicial = $instrumento1->getEdad();
$instrumento1->setDescripcion("instrumento de viento antiguo");
$instrumento1->envejecer();

// Acceso a una propiedad protegida y creación de una propiedad nueva (sobrecarga deshabilitada)
try {
    $instrumento1->_edad = 50;
    $errorProtegida = "";
} catch (Exception $e) {
    $errorProtegida = $e->getMessage();
}
try {
    $instrumento1->color = "rojo";
    $errorDinamica = "";
} catch (Exception $e) {
    $errorDinamica = $e->getMessage();
}

// ---------- Ejercicio 2: IFabricable ----------
$metodosInterfaz = get_class_methods("IFabricable");

// ---------- Ejercicio 3: InstrumentoViento ----------
$viento = new InstrumentoViento("metal", 20);

// ---------- Ejercicio 4: Flauta ----------
$flauta1 = Flauta::CrearDesdeArray(["material" => "plata", "edad" => 3]);
$flauta2 = Flauta::CrearDesdeArray([]);  // sin datos: valores por defecto
$flautaClon = clone $flauta1;
try {
    $flautaNew = new Flauta();
    $errorConstructor = "";
} catch (Error $e) {
    $errorConstructor = $e->getMessage();
}

// ---------- Ejercicio 5: EstadoCivil y Persona ----------
$casos = EstadoCivil::casos();

// estado a partir de un valor aleatorio de entre los posibles
$valores = array_map(fn(EstadoCivil $caso) => $caso->valor(), $casos);
$valorAleatorio = $valores[array_rand($valores)];
$persona = Persona::registrarPersona(
    "Lucía",
    "15/03/2001",
    "calle Real 4",
    "Málaga",
    EstadoCivil::from($valorAleatorio)
);

try {
    $personaMal = Persona::registrarPersona("Pedro", "31/02/2000", "calle Luna 1", "Antequera", EstadoCivil::Casado);
    $errorPersona = "";
} catch (InvalidArgumentException $e) {
    $errorPersona = $e->getMessage();
}

// ---------- Ejercicio 6: SerieFibonacci ----------
$serie = new SerieFibonacci(10);
$generador = SerieFibonacci::fFibonacci(10);

// ---------- Ejercicio 7: ClaseMisPropiedades ----------
$Objeto = new ClaseMisPropiedades();
$Objeto->propPublica = "publica";
$Objeto->propiedad1 = 25;
$Objeto->propiedad2 = "cadena de texto";

try {
    $Objeto->_propPrivada = "privada";
    $errorPrivada = "";
} catch (Exception $e) {
    $errorPrivada = $e->getMessage();
}
try {
    $valor3 = $Objeto->propiedad3;
    $errorPropiedad3 = "";
} catch (Exception $e) {
    $errorPropiedad3 = $e->getMessage();
}

// Todo lo que necesita la vista
$pruebas = [
    "errorAbstracta" => $errorAbstracta,
    "instrumento1" => $instrumento1,
    "descripcionInicial" => $descripcionInicial,
    "edadInicial" => $edadInicial,
    "errorProtegida" => $errorProtegida,
    "errorDinamica" => $errorDinamica,
    "metodosInterfaz" => $metodosInterfaz,
    "viento" => $viento,
    "flauta1" => $flauta1,
    "flauta2" => $flauta2,
    "flautaClon" => $flautaClon,
    "errorConstructor" => $errorConstructor,
    "casos" => $casos,
    "valorAleatorio" => $valorAleatorio,
    "persona" => $persona,
    "errorPersona" => $errorPersona,
    "serie" => $serie,
    "generador" => $generador,
    "Objeto" => $Objeto,
    "errorPrivada" => $errorPrivada,
    "errorPropiedad3" => $errorPropiedad3
];


// Dibuja la plantilla de la vista
inicioCabecera("Relación 4");
cabecera();
finCabecera();
inicioCuerpo("Relación 4: Clases, objetos y enumeraciones", $barra);
cuerpo($enunciados, $pruebas);  // llamo a la vista
finCuerpo();


// ********************************************************************
// VISTA
// ********************************************************************

function cabecera(): void
{
?>
    <!-- esto va en el head (los estilos están en /estilos/base.css) -->
<?php
}

function cuerpo(array $enunciados, array $p): void
{
?>
    <main id="main">

        <!-- Índice con enlaces a cada ejercicio -->
        <nav>
            <strong>Ejercicios</strong>
            <ol>
                <?php foreach ($enunciados as $num => $ej) { ?>
                    <li><a href="#ej<?= $num ?>"><?= $ej["titulo"] ?></a></li>
                <?php } ?>
            </ol>
        </nav>

        <!-- EJERCICIO 1 -->
        <section id="ej1">
            <?php mostrarEnunciado(1, $enunciados[1]); ?>
            <div class="resultado">
                <p><strong>new InstrumentoBase():</strong></p>
                <?php mostrarError($p["errorAbstracta"], "Se ha podido instanciar (no es abstracta)"); ?>

                <p>Se prueba a través de la clase hija InstrumentoViento:</p>
                <ul>
                    <li>getDescripcion(): <?= $p["descripcionInicial"] ?></li>
                    <li>getEdad(): <?= $p["edadInicial"] ?></li>
                    <li>Después de setDescripcion("instrumento de viento antiguo") y envejecer():</li>
                </ul>
                <p><?= $p["instrumento1"] ?></p>

                <p><strong>$instrumento1->_edad = 50:</strong></p>
                <?php mostrarError($p["errorProtegida"], "Se ha podido asignar"); ?>
                <p><strong>$instrumento1->color = "rojo":</strong></p>
                <?php mostrarError($p["errorDinamica"], "Se ha podido crear la propiedad"); ?>
            </div>
        </section>

        <!-- EJERCICIO 2 -->
        <section id="ej2">
            <?php mostrarEnunciado(2, $enunciados[2]); ?>
            <div class="resultado">
                <p>Métodos de la interfaz IFabricable: <code><?= implode("()</code>, <code>", $p["metodosInterfaz"]) ?>()</code></p>
                <p>La implementa la clase Flauta (ver ejercicio 4).
                    ¿$flauta1 es IFabricable? <strong><?= $p["flauta1"] instanceof IFabricable ? "Sí" : "No" ?></strong></p>
            </div>
        </section>

        <!-- EJERCICIO 3 -->
        <section id="ej3">
            <?php mostrarEnunciado(3, $enunciados[3]); ?>
            <div class="resultado">
                <p><strong>new InstrumentoViento("metal", 20):</strong></p>
                <p><?= $p["viento"] ?></p>
                <ul>
                    <li>sonido(): <?= $p["viento"]->sonido() ?></li>
                    <li>afinar(): <?= $p["viento"]->afinar() ?></li>
                </ul>
            </div>
        </section>

        <!-- EJERCICIO 4 -->
        <section id="ej4">
            <?php mostrarEnunciado(4, $enunciados[4]); ?>
            <div class="resultado">
                <p><strong>Flauta::CrearDesdeArray(["material" => "plata", "edad" => 3]):</strong></p>
                <p><?= $p["flauta1"] ?></p>
                <ul>
                    <li>sonido(): <?= $p["flauta1"]->sonido() ?></li>
                    <li>metodoFabricacion(): <?= $p["flauta1"]->metodoFabricacion() ?></li>
                    <li>metodoReciclado(): <?= $p["flauta1"]->metodoReciclado() ?></li>
                </ul>

                <p><strong>Flauta::CrearDesdeArray([]) (valores por defecto):</strong></p>
                <p><?= $p["flauta2"] ?></p>

                <p><strong>clone $flauta1 (edad 0 y nuevo número de instancia):</strong></p>
                <p><?= $p["flautaClon"] ?></p>

                <p><strong>new Flauta():</strong></p>
                <?php mostrarError($p["errorConstructor"], "Se ha podido crear"); ?>
            </div>
        </section>

        <!-- EJERCICIO 5 -->
        <section id="ej5">
            <?php mostrarEnunciado(5, $enunciados[5]); ?>
            <div class="resultado">
                <p><strong>EstadoCivil::casos():</strong></p>
                <table class="tabla">
                    <tr>
                        <th>Caso</th>
                        <th>descripcion()</th>
                        <th>valor()</th>
                    </tr>
                    <?php foreach ($p["casos"] as $caso) { ?>
                        <tr>
                            <td>EstadoCivil::<?= $caso->name ?></td>
                            <td><?= $caso->descripcion() ?></td>
                            <td><?= $caso->valor() ?></td>
                        </tr>
                    <?php } ?>
                </table>

                <p><strong>Persona con estado a partir del valor aleatorio <?= $p["valorAleatorio"] ?>:</strong></p>
                <p><?= $p["persona"] ?></p>

                <p><strong>Persona con fecha 31/02/2000:</strong></p>
                <?php mostrarError($p["errorPersona"], "Se ha creado (la fecha no se valida)"); ?>
            </div>
        </section>

        <!-- EJERCICIO 6 -->
        <section id="ej6">
            <?php mostrarEnunciado(6, $enunciados[6]); ?>
            <div class="resultado">
                <p><strong>foreach (new SerieFibonacci(10) as $valor):</strong></p>
                <p>
                    <?php
                    foreach ($p["serie"] as $valor)
                        echo "$valor &nbsp;";
                    ?>
                </p>

                <p><strong>foreach (SerieFibonacci::fFibonacci(10) as $n => $valor) (generador):</strong></p>
                <p>
                    <?php
                    foreach ($p["generador"] as $n => $valor)
                        echo "F($n) = $valor &nbsp; ";
                    ?>
                </p>
            </div>
        </section>

        <!-- EJERCICIO 7 -->
        <section id="ej7">
            <?php mostrarEnunciado(7, $enunciados[7]); ?>
            <div class="resultado">
                <p>la propiedad 1 vale <?= $p["Objeto"]->propiedad1 ?></p>

                <p><strong>$Objeto->_propPrivada = "privada":</strong></p>
                <?php mostrarError($p["errorPrivada"], "Se ha podido asignar"); ?>

                <p><strong>echo $Objeto->propiedad3:</strong></p>
                <?php mostrarError($p["errorPropiedad3"], "Se ha podido leer"); ?>

                <p><strong>foreach ($Objeto as $clave => $valor):</strong></p>
                <table class="tabla">
                    <tr>
                        <th>Clave</th>
                        <th>Valor</th>
                    </tr>
                    <?php foreach ($p["Objeto"] as $clave => $valor) { ?>
                        <tr>
                            <td><?= $clave ?></td>
                            <td><?= htmlspecialchars((string)$valor) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </section>

    </main>
<?php
}
// ********************************************************************
// FUNCIONES AUXILIARES DE LA VISTA
// ********************************************************************

/**
 * Muestra el enunciado de un ejercicio: título, texto, listas y código de ejemplo
 *
 * @param integer $num número del ejercicio
 * @param array $ej datos del enunciado (titulo, intro, puntos, intro2, puntos2, codigo, final)
 * @return void
 */
function mostrarEnunciado(int $num, array $ej): void
{
    echo "<h2>$num.- {$ej["titulo"]}</h2>" . PHP_EOL;
    echo "<div class='enunciado'>" . PHP_EOL;

    echo "<p>{$ej["intro"]}</p>" . PHP_EOL;
    mostrarLista($ej["puntos"]);

    // segunda parte (solo en algunos ejercicios)
    if (isset($ej["intro2"])) {
        echo "<p>{$ej["intro2"]}</p>" . PHP_EOL;
        mostrarLista($ej["puntos2"] ?? []);
    }

    // código de ejemplo: se escapa para que se vea tal cual y no se interprete
    if (isset($ej["codigo"])) {
        echo "<pre>" . htmlspecialchars($ej["codigo"]) . "</pre>" . PHP_EOL;
    }

    if (isset($ej["final"])) {
        echo "<p>{$ej["final"]}</p>" . PHP_EOL;
    }

    echo "</div>" . PHP_EOL;
}

/**
 * Muestra un array de cadenas como lista HTML
 *
 * @param array $puntos elementos de la lista
 * @return void
 */
function mostrarLista(array $puntos): void
{
    if (count($puntos) == 0)
        return;

    echo "<ul>" . PHP_EOL;
    foreach ($puntos as $punto)
        echo "<li>$punto</li>" . PHP_EOL;
    echo "</ul>" . PHP_EOL;
}


/**
 * Muestra el mensaje de error de una prueba que debía fallar
 *
 * @param string $error mensaje capturado (vacío si no hubo error)
 * @param string $siNoFalla texto a mostrar si no se produjo el error
 * @return void
 */
function mostrarError(string $error, string $siNoFalla): void
{
    if ($error != "")
        echo "<div class='ok'>Error esperado: " . htmlspecialchars($error) . "</div>" . PHP_EOL;
    else
        echo "<div class='error'>$siNoFalla</div>" . PHP_EOL;
}
