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

    /**
     * Segun el material de la flauta se fabrica de una forma u otra
     * @return string pasos para fabricarla
     */
    public function metodoFabricacion(): string
    {
        $material = mb_strtolower($this->_material);

        if ($material === "madera")
            return "Tornear el tubo de madera, perforar los agujeros y barnizar.";
        if ($material === "metal" || $material === "plata")
            return "Hacer el tubo con la chapa de $material, soldar las llaves y pulir.";
        if ($material === "plastico")
            return "Meter el plastico en un molde y lijar los bordes.";

        return "Dar forma al tubo de $material y perforar los agujeros.";
    }

    /**
     * El reciclado depende tambien del material
     * @return string donde se recicla
     */
    public function metodoReciclado(): string
    {
        $material = mb_strtolower($this->_material);

        if ($material === "madera")
            return "Contenedor de restos de madera o punto limpio.";
        if ($material === "metal" || $material === "plata")
            return "Punto limpio para recuperar el metal.";
        if ($material === "plastico")
            return "Contenedor amarillo.";

        return "Llevar al punto limpio.";
    }
}
