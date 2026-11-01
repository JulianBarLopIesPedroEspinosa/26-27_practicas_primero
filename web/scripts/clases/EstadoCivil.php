<?php

/**
 * Enumeración EstadoCivil (ejercicio 5)
 * Enumeración "respaldada" (backed enum) con valores enteros.
 */
enum EstadoCivil: int
{
    case Soltero = 10;
    case Casado = 20;
    case Pareja = 30;
    case Viudo = 40;

    /**
     * Devuelve el nombre del caso (en minúsculas para usarlo en frases)
     */
    public function descripcion(): string
    {
        return mb_strtolower($this->name);
    }

    /**
     * Devuelve el valor del caso
     */
    public function valor(): int
    {
        return $this->value;
    }

    /**
     * Devuelve un array con todos los casos
     */
    public static function casos(): array
    {
        return self::cases();
    }
}
