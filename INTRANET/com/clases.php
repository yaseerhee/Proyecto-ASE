<?php

abstract class Dato
{
}

trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

class Familia extends Dato
{
    use Identificable;
    private string $direccion;
    private string $representante;

    public function __construct(int $id, string $direccion, string $representante)
    {
        $this->setId($id);
        $this->setDireccion($direccion);
        $this->setRepresentante($representante);
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion)
    {
        $this->direccion = $direccion;
    }

    public function getRepresentante(): string
    {
        return $this->representante;
    }

    public function setRepresentante(string $representante)
    {
        $this->representante = $representante;
    }
}


class Persona extends Dato
{
    use Identificable;
    private string $nie;
    private string $nombre;
    private string $apellidos;
    private string $telefono;
    private int $sexo;
    private string $numero;
    private string $nacionalidad;
    private string $nacimiento;

    public function __construct(int $id, string $nie, string $nombre, string $apellidos, string $telefono, $sexo, string $numero, string $nacionalidad, string $nacimiento)
    {
        $this->setId($id);
        $this->setNie($nie);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setTelefono($telefono);
        $this->setSexo($sexo);
        $this->setNumero($numero);
        $this->setNacionalidad($nacionalidad);
        $this->setNacimiento($nacimiento);
    }

    public function getNie(): string
    {
        return $this->nie;
    }

    public function setNie(string $nie)
    {
        $this->nie = $nie;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono)
    {
        $this->telefono = $telefono;
    }

    public function getSexo(): int
    {
        return $this->sexo;
    }

    public function setSexo(int $sexo)
    {
        $this->sexo = $sexo;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(string $numero)
    {
        $this->numero = $numero;
    }

    public function getNacionalidad(): string
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(string $nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;
    }

    public function getNacimiento(): string
    {
        return $this->nacimiento;
    }

    public function setNacimiento(string $nacimiento)
    {
        $this->nacimiento = $nacimiento;
    }
}

class Usuario extends Dato
{
    use Identificable;

    private string $identificador;
    private string $email;
    private string $contrasenna;
    private bool $tipo;
    private string $codigoCookie;


    public function __construct(int $id, string $identificador, string $email, string $contrasenna, bool $tipo)
    {
        $this->setId($id);
        $this->setIdentificador($identificador); //nombreUsuario
        $this->setEmail($email); //nombreUsuario
        $this->setContrasenna($contrasenna);
        $this->setTipo($tipo);
    }

    public function getIdentificador(): string
    {
        return $this->identificador;
    }

    public function setIdentificador(string $identificador)
    {
        $this->identificador = $identificador;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getContrasenna(): string
    {
        return $this->contrasenna;
    }

    public function setContrasenna(string $contrasenna)
    {
        $this->contrasenna = $contrasenna;
    }

    public function getTipo(): bool
    {
        return $this->tipo;
    }

    public function setTipo(bool $tipo)
    {
        $this->tipo = $tipo;
    }

    public function getCodigoCookie()
    {
        return $this->codigoCookie;
    }

    public function setCodigoCookie($codigoCookie)
    {
        $this->codigoCookie = $codigoCookie;
    }
}
