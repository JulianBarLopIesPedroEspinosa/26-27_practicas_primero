<?php

class Punto
{
    public const COLORES = [
        'black' => [
            'nombre' => 'negro',
            'rgb' => ['0', '0', '0']
        ],
        'blue' => [
            'nombre' => 'azul',
            'rgb' => ['0', '0', '255']
        ],
        'red' => [
            'nombre' => 'rojo',
            'rgb' => ['255', '0', '0']
        ],
        'green' => [
            'nombre' => 'verde',
            'rgb' => ['0', '255', '0']
        ]
    ];

    public const GROSORES = [
        1 => 'fino',
        2 => 'medio',
        3 => 'grueso'
    ];

    private int $_x, $_y, $_grosor;
    private string $_color;

    public function __construct(int $x, int $y, string $color, int $grosor)
    {
        if ($x < 0 || $x > 20000) throw new Exception("El valor x tiene que estar entre 0 y 20000");
        if ($y < 0 || $y > 20000) throw new Exception("El valor y tiene que estar entre 0 y 20000");

        if(in_array(self::COLORES,$color)) throw new Exception("El valor y tiene que estar en COLORES");

    }
}
