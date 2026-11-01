<?php

/**
 * Clase abstracta InstrumentoBase (ejercicio 1)
 * Clase base de todos los instrumentos. Al ser abstracta no se puede hacer new InstrumentoBase().
 * (Para probarla al principio se quitaba "abstract" y se daba cuerpo a sonido() y afinar())
 */
abstract class InstrumentoBase
{
    //---------------- ATRIBUTOS ----------------

    // descripción: privada, solo accesible con getDescripcion/setDescripcion
    private string $_descripcion = "";

    // edad: protegida (la ven las clases hijas, no el exterior). Por defecto 10
    protected int $_edad = 10;

    // variable de CLASE (static): cuántos instrumentos se han creado en total
    protected static int $_numInstancias = 0;

    // propiedad de INSTANCIA: número de orden en que se creó este objeto
    protected int $_numOrden = 0;

    //---------------- CONSTRUCTOR ----------------

    /**
     * @param string $descripcion descripción del instrumento
     * @param integer $edad edad en años (por defecto 10)
     * @throws InvalidArgumentException si la edad es negativa
     */
    public function __construct(string $descripcion = "", int $edad = 10)
    {
        if ($edad < 0)
            throw new InvalidArgumentException("La edad no puede ser negativa");

        $this->setDescripcion($descripcion);
        $this->_edad = $edad;

        // incremento el contador de clase y guardo el orden de esta instancia
        // (self:: para que todas las clases hijas compartan el mismo contador)
        self::$_numInstancias++;
        $this->_numOrden = self::$_numInstancias;
    }

    //---------------- GET / SET ----------------

    public function getDescripcion(): string
    {
        return $this->_descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->_descripcion = trim($descripcion);
    }

    public function getEdad(): int
    {
        return $this->_edad;
    }

    //---------------- MÉTODOS ----------------

    /**
     * Aumenta la edad del instrumento en un año
     */
    public function envejecer(): void
    {
        $this->_edad++;
    }

    /**
     * Devuelve una frase que representa el sonido del instrumento
     */
    abstract public function sonido(): string;

    /**
     * Devuelve los pasos necesarios para afinar el instrumento
     */
    abstract public function afinar(): string;

    /**
     * Lo que se muestra al hacer echo del objeto
     */
    public function __toString(): string
    {
        return "instrumento con descripción {$this->_descripcion}, instancia {$this->_numOrden}"
            . " de un total de " . self::$_numInstancias
            . ". Tiene {$this->_edad} años. La clase es " . get_class($this);
    }

    //---------------- SOBRECARGA DESHABILITADA ----------------
    // Impiden crear/leer/comprobar/borrar propiedades que no existen o no son accesibles

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
