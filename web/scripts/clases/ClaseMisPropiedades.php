<?php

/**
 * Clase ClaseMisPropiedades (ejercicio 7)
 * Permite añadir propiedades dinámicas (se guardan en $_propiedades) y es iterable.
 * Aquí la sobrecarga SÍ se usa: __get/__set trabajan sobre el array $_propiedades.
 */
class ClaseMisPropiedades implements IteratorAggregate
{
    private array $_propiedades = [];  // propiedades dinámicas: nombre => valor
    public mixed $propPublica = null;
    private mixed $_propPrivada = 25;

    /**
     * Se llama al asignar una propiedad que no existe o no es accesible
     *
     * @throws Exception si se intenta asignar _propPrivada (o _propiedades)
     */
    public function __set(string $nombre, mixed $valor): void
    {
        if ($nombre == "_propPrivada" || $nombre == "_propiedades")
            throw new Exception("No se puede asignar un valor a la propiedad $nombre");

        $this->_propiedades[$nombre] = $valor;
    }

    /**
     * Se llama al leer una propiedad que no existe o no es accesible
     *
     * @throws Exception si la propiedad no se ha asignado antes
     */
    public function __get(string $nombre): mixed
    {
        if (!array_key_exists($nombre, $this->_propiedades))
            throw new Exception("La propiedad $nombre no existe");

        return $this->_propiedades[$nombre];
    }

    public function __isset(string $nombre): bool
    {
        return isset($this->_propiedades[$nombre]);
    }

    public function __unset(string $nombre): void
    {
        unset($this->_propiedades[$nombre]);
    }

    /**
     * Metodo de IteratorAggregate, es el que usa el foreach.
     * Montamos un array con las claves con oi_ delante, primero las dinamicas
     * y al final propPublica y _propPrivada, y devolvemos un iterador de ese array
     * @return Iterator
     */
    public function getIterator(): Iterator
    {
        $resultado = [];
        foreach ($this->_propiedades as $nombre => $valor)
            $resultado["oi_" . $nombre] = $valor;

        $resultado["oi_propPublica"] = $this->propPublica;
        $resultado["oi__propPrivada"] = $this->_propPrivada;

        return new ArrayIterator($resultado);
    }
}
