<?php

/**
 * Clase InstrumentoViento (ejercicio 3)
 * Hereda de InstrumentoBase. Su descripción siempre es "instrumento de viento".
 */
class InstrumentoViento extends InstrumentoBase
{
    // material: protegido (accesible desde las hijas, no desde fuera). Sin get/set
    protected string $_material = "madera";

    /**
     * @param string $material material del instrumento (por defecto madera)
     * @param integer $edad edad en años (por defecto 15)
     * @throws InvalidArgumentException si el material está vacío o la edad es negativa
     */
    public function __construct(string $material = "madera", int $edad = 15)
    {
        $material = trim($material);
        if (mb_strlen($material) == 0)
            throw new InvalidArgumentException("El material no puede estar vacío");

        parent::__construct("instrumento de viento", $edad);
        $this->_material = $material;
    }

    /**
     * Sonido genérico de un instrumento de viento
     */
    public function sonido(): string
    {
        return "Fuuuuu, el aire vibra dentro del tubo";
    }

    /**
     * final: las clases derivadas no pueden redefinir este método
     */
    final public function afinar(): string
    {
        return "1. Tocar la nota La de referencia (440 Hz). "
            . "2. Si suena alto, alargar el tubo sacando un poco la cabeza o boquilla. "
            . "3. Si suena bajo, acortarlo metiéndola. "
            . "4. Repetir hasta que coincida con la referencia.";
    }

    /**
     * Texto de la clase base + el material
     */
    public function __toString(): string
    {
        return parent::__toString() . ". Instrumento de material {$this->_material}";
    }
}
