<?php

/**
 * Clase Flauta (ejercicio 4)
 * Es un instrumento de viento fabricable.
 * final: no se puede heredar de ella.
 */
final class Flauta extends InstrumentoViento implements IFabricable
{
    /**
     * Constructor privado: los objetos se crean con Flauta::CrearDesdeArray()
     */
    private function __construct(string $material = "madera", int $edad = 15)
    {
        parent::__construct($material, $edad);
    }

    /**
     * Constructor estático
     *
     * @param array $datos array asociativo con las posiciones "material" y "edad" (opcionales)
     * @return Flauta nueva flauta con esos valores (o los de por defecto si no aparecen)
     */
    public static function CrearDesdeArray(array $datos): Flauta
    {
        $material = $datos["material"] ?? "madera";
        $edad = $datos["edad"] ?? 15;

        return new Flauta((string)$material, (int)$edad);
    }

    /**
     * Al clonar: mismos valores salvo la edad (0) y el número de instancia,
     * porque realmente es una instancia nueva
     */
    public function __clone(): void
    {
        $this->_edad = 0;
        self::$_numInstancias++;
        $this->_numOrden = self::$_numInstancias;
    }

    /**
     * Sonido propio de la flauta (afinar no se puede redefinir, es final en InstrumentoViento)
     */
    public function sonido(): string
    {
        return "Fiu fiu fiuuu";
    }

    //---------------- Métodos de IFabricable ----------------

    public function metodoFabricacion(): string
    {
        return match (mb_strtolower($this->_material)) {
            "madera" => "Tornear el tubo de madera, perforar los agujeros y barnizar.",
            "metal", "plata" => "Laminar la chapa de {$this->_material}, darle forma de tubo, soldar las llaves y pulir.",
            "plástico", "plastico" => "Inyectar el plástico en un molde y lijar las rebabas.",
            default => "Dar forma al tubo de {$this->_material} y perforar los agujeros."
        };
    }

    public function metodoReciclado(): string
    {
        return match (mb_strtolower($this->_material)) {
            "madera" => "Contenedor de restos de madera o punto limpio.",
            "metal", "plata" => "Punto limpio para recuperar el metal.",
            "plástico", "plastico" => "Contenedor amarillo.",
            default => "Llevar al punto limpio."
        };
    }
}
