<?php

/**
 * Interfaz IFabricable (ejercicio 2)
 * Indica cómo se fabrica un elemento y cómo se recicla.
 */
interface IFabricable
{
    /**
     * Devuelve los pasos para fabricar el elemento
     */
    public function metodoFabricacion(): string;

    /**
     * Devuelve el método de reciclado que se debe aplicar al elemento según su fabricación
     */
    public function metodoReciclado(): string;
}
