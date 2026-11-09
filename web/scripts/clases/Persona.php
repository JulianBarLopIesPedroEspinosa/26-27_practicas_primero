<?php

/**
 * Clase Persona (ejercicio 5)
 * Los objetos se crean con el constructor estático Persona::registrarPersona()
 */
class Persona
{
    //---------------- ATRIBUTOS (todos privados) ----------------
    private string $_nombre;
    private string $_fecha_nacimiento;
    private string $_domicilio;
    private string $_localidad;
    private EstadoCivil $_estado;

    /**
     * Constructor privado sin parámetros: rellena valores de prueba
     */
    private function __construct()
    {
        $this->_nombre = "prueba";
        $this->_fecha_nacimiento = "01/01/2000";
        $this->_domicilio = "carrera 12";
        $this->_localidad = "antequera";
        $this->_estado = EstadoCivil::Soltero;
    }

    /**
     * Constructor estático: crea una persona con todos sus datos
     *
     * @throws InvalidArgumentException si algún dato no es válido
     */
    public static function registrarPersona(
        string $nombre,
        string $fecha_nacimiento,
        string $domicilio,
        string $localidad,
        EstadoCivil $estado
    ): Persona {
        $persona = new Persona();

        // uso los set para que se apliquen las comprobaciones
        $persona->setNombre($nombre);
        $persona->setFechaNacimiento($fecha_nacimiento);
        $persona->setDomicilio($domicilio);
        $persona->setLocalidad($localidad);
        $persona->setEstado($estado);

        return $persona;
    }

    //---------------- GET / SET ----------------

    public function getNombre(): string
    {
        return $this->_nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->_nombre = $this->compruebaTexto($nombre, "nombre");
    }

    public function getFechaNacimiento(): string
    {
        return $this->_fecha_nacimiento;
    }

    /**
     * @param string $fecha fecha con formato dd/mm/aaaa
     * @throws InvalidArgumentException si la fecha no es válida
     */
    public function setFechaNacimiento(string $fecha): void
    {
        $fecha = trim($fecha);
        $partes = explode("/", $fecha);

        if (count($partes) != 3 || !checkdate((int)$partes[1], (int)$partes[0], (int)$partes[2]))
            throw new InvalidArgumentException("La fecha $fecha no es válida (formato dd/mm/aaaa)");

        $this->_fecha_nacimiento = $fecha;
    }

    public function getDomicilio(): string
    {
        return $this->_domicilio;
    }

    public function setDomicilio(string $domicilio): void
    {
        $this->_domicilio = $this->compruebaTexto($domicilio, "domicilio");
    }

    public function getLocalidad(): string
    {
        return $this->_localidad;
    }

    public function setLocalidad(string $localidad): void
    {
        $this->_localidad = $this->compruebaTexto($localidad, "localidad");
    }

    public function getEstado(): EstadoCivil
    {
        return $this->_estado;
    }

    public function setEstado(EstadoCivil $estado): void
    {
        $this->_estado = $estado;
    }

    //---------------- MÉTODOS ----------------

    /**
     * "Nombre es una persona estado nacida en fecha_nacimiento y que vive en localidad"
     */
    public function __toString(): string
    {
        return "{$this->_nombre} es una persona {$this->_estado->descripcion()} nacida en "
            . "{$this->_fecha_nacimiento} y que vive en {$this->_localidad}";
    }

    /**
     * Quita espacios y comprueba que el texto no esté vacío (método privado auxiliar)
     *
     * @throws InvalidArgumentException si el texto queda vacío
     */
    private function compruebaTexto(string $texto, string $campo): string
    {
        $texto = trim($texto);
        if (mb_strlen($texto) == 0)
            throw new InvalidArgumentException("El campo $campo no puede estar vacío");

        return $texto;
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
