<?php

class Punto
{
    public const COLORES = [
        'black' => ['nombre' => 'negro', 'rgb' => [0, 0, 0]],
        'blue'  => ['nombre' => 'azul',  'rgb' => [0, 0, 255]],
        'red'   => ['nombre' => 'rojo',  'rgb' => [255, 0, 0]],
        'green' => ['nombre' => 'verde', 'rgb' => [0, 255, 0]],
    ];

    public const GROSORES = [
        1 => 'fino',
        2 => 'medio',
        3 => 'grueso',
    ];

    private int $_x;
    private int $_y;
    private string $_color;
    private int $_grosor;

    public function __construct(int $x, int $y, string $color, int $grosor)
    {
        if (!$this->setX($x)) {
            throw new InvalidArgumentException("El valor x tiene que estar entre 0 y 20000");
        }
        if (!$this->setY($y)) {
            throw new InvalidArgumentException("El valor y tiene que estar entre 0 y 20000");
        }
        if (!$this->setColor($color)) {
            throw new InvalidArgumentException("El color tiene que estar en COLORES");
        }
        if (!$this->setGrosor($grosor)) {
            throw new InvalidArgumentException("El grosor tiene que estar en GROSORES");
        }
    }

    public function setX(int $x): bool
    {
        if ($x < 0 || $x > 20000) return false;
        $this->_x = $x;
        return true;
    }

    public function setY(int $y): bool
    {
        if ($y < 0 || $y > 20000) return false;
        $this->_y = $y;
        return true;
    }

    public function setColor(string $color): bool
    {
        if (!array_key_exists($color, self::COLORES)) return false;
        $this->_color = $color;
        return true;
    }

    public function setGrosor(int $grosor): bool
    {
        if (!array_key_exists($grosor, self::GROSORES)) return false;
        $this->_grosor = $grosor;
        return true;
    }

    public function getX(): int { return $this->_x; }
    public function getY(): int { return $this->_y; }
    public function getColor(): string { return $this->_color; }
    public function getGrosor(): int { return $this->_grosor; }

    // Impide crear propiedades dinámicas
    public function __set(string $name, mixed $value): void
    {
        throw new LogicException("No se pueden crear propiedades dinámicas: $name");
    }
}