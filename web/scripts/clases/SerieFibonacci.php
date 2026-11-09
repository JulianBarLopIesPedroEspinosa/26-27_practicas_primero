<?php

/**
 * Clase SerieFibonacci (ejercicio 6)
 * Implementa Iterator para poder recorrerla con foreach:
 *     foreach (new SerieFibonacci(10) as $valor) ...  -> 0 1 1 2 3 5 8 13 21 34 55
 */
class SerieFibonacci implements Iterator
{
    private int $_limite;          // hasta qué elemento se genera la serie
    private int $_claveActual = 0; // elemento actual para el que se calcula la serie

    /**
     * @param integer $limite último elemento de la serie (F(0) ... F(limite))
     * @throws InvalidArgumentException si el límite es negativo
     */
    public function __construct(int $limite)
    {
        if ($limite < 0)
            throw new InvalidArgumentException("El límite no puede ser negativo");

        $this->_limite = $limite;
    }

    //---------------- Métodos de Iterator ----------------

    // valor del elemento actual: F(claveActual)
    public function current(): int
    {
        return $this->calcular($this->_claveActual);
    }

    // clave del elemento actual
    public function key(): int
    {
        return $this->_claveActual;
    }

    // pasa al siguiente elemento
    public function next(): void
    {
        $this->_claveActual++;
    }

    // vuelve al principio (lo llama foreach al empezar)
    public function rewind(): void
    {
        $this->_claveActual = 0;
    }

    // ¿quedan elementos?
    public function valid(): bool
    {
        return $this->_claveActual <= $this->_limite;
    }

    //---------------- Generador ----------------

    /**
     * Serie de Fibonacci con un generador: F(0) ... F($ultimo)
     *
     * @param integer $ultimo último elemento a generar
     * @return Generator
     */
    public static function fFibonacci(int $ultimo): Generator
    {
        $anterior = 0; // F(n)
        $siguiente = 1; // F(n+1)

        for ($n = 0; $n <= $ultimo; $n++) {
            yield $n => $anterior; // devuelve el valor y la funcion se "pausa" hasta el siguiente

            $suma = $anterior + $siguiente;
            $anterior = $siguiente;
            $siguiente = $suma;
        }
    }

    //---------------- Métodos privados ----------------

    /**
     * F(n) con la fórmula de Binet: (φ^n − (1−φ)^n) / √5
     */
    private function calcular(int $n): int
    {
        $phi = (1 + sqrt(5)) / 2;
        return (int)round((pow($phi, $n) - pow(1 - $phi, $n)) / sqrt(5));
    }

    //---------------- SOBRECARGA DESHABILITADA ----------------

    public function __get(string $nombre): mixed
    {
        throw new Exception("La propiedad $nombre no existe o no es accesible");
    }

    public function __set(string $nombre, mixed $valor): void
    {
        throw new Exception("No se puede asignar la propiedad $nombre");
    }

    public function __isset(string $nombre): bool
    {
        return false;
    }

    public function __unset(string $nombre): void
    {
        throw new Exception("No se puede eliminar la propiedad $nombre");
    }
}
