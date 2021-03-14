<?php

require_once "varios.php";
require_once "clases.php";
session_start();
class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD()
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "ase"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }

        return $pdo;
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $select = self::$pdo->prepare($sql);
        $select->execute($parametros);
        $rs = $select->fetchAll();

        return $rs;
    }

    private static function ejecutarActualizacion(string $sql, array $parametros): ?int
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $actualizacion = self::$pdo->prepare($sql);
        $sqlConExito = $actualizacion->execute($parametros);

        if (!$sqlConExito) return null;
        else return $actualizacion->rowCount();
    }

    /////////////////EQUIPO///////////////////////
    public static function personaCrearDesdeRs(array $rs): Persona
    {
        return new Persona($rs["id"], $rs["nie"], $rs["nombre"], $rs["apellidos"], $rs["telefono"], $rs["sexo"], $rs["numero"], $rs["nacionalidad"], $rs["fecha_nacimiento"]);
    }

    public static function personaCrear(String $nie, String $nombre, String $apellidos, String $telefono, int $sexo, int $numero, String $nacionalidad, String $nacimiento): bool
    {
        return self::ejecutarActualizacion(
            "INSERT INTO Persona (nie,nombre,apellidos,telefono,sexo,numero,nacionalidad,fecha_nacimiento) VALUES(?,?,?,?,?,?,?,?)",
            [$nie, $nombre, $apellidos, $telefono, $sexo, $numero, $nacionalidad, $nacimiento]
        );
    }

    public static function equipoObtenerPorID(int $id): ?Persona
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Persona WHERE id=?",
            [$id]
        );
        if ($rs)
            return self::personaCrearDesdeRs($rs[0]);
        else
            return null;
    }

    public static function personaObtenerTodas(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Persona",
            []
        );
        foreach ($rs as $fila) {
            $personas = self::personaCrearDesdeRs($fila);
            array_push($datos, $personas);
        }
        return $datos;
    }

    public static function personaEliminarPorID(int $id): bool
    {
        return self::ejecutarActualizacion(
            "DELETE FROM Persona WHERE id=?",
            [$id]
        );
    }

    public static function personaActualizarPorId(
        int $id,
        string $nie,
        string $nombre,
        string $apellidos,
        string $telefono,
        int $sexo,
        int $numero,
        string $nacionalidad,
        string $nacimiento
    ): bool {
        return self::ejecutarActualizacion(
            "UPDATE Persona SET nie=?, nombre=?, apellidos=?, telefono=?, sexo=?, numero=?, nacionalidad=?, fecha_nacimiento=? WHERE id=?",
            [
                $nie, $nombre, $apellidos, $telefono, $sexo, $numero, $nacionalidad, $nacimiento, $id
            ]
        );
    }
    public static function personaFicha($id): array
    {
        $nuevaEntrada = ($id == -1);
        if ($nuevaEntrada) {
            $nie = "<introduzca nie>";
            $nombre = "<introduzca nombre>";
            $apellidos = "<introduzca apellidos>";
            $telefono = "";
            $sexo = 0;
            $numero = 0;
            $nacionalidad = "";
            $nacimiento = "";
        } else {
            $rs = self::ejecutarConsulta(
                "SELECT * FROM Persona WHERE id=?",
                [$id]
            );
            $nie = $rs[0]["nie"];
            $nombre = $rs[0]["nombre"];
            $apellidos = $rs[0]["apellidos"];
            $telefono = $rs[0]["telefono"];
            $sexo = $rs[0]["sexo"];
            $numero = $rs[0]["numero"];
            $nacionalidad = $rs[0]["nacionalidad"];
            $nacimiento = $rs[0]["fecha_nacimiento"];
        }

        return [$nuevaEntrada, $nie, $nombre, $apellidos, $telefono, $sexo, $numero, $nacionalidad, $nacimiento];
    }

    /////////////////Familia///////////////////////
    private static function familiaCrearDesdeRs(array $rs): Familia
    {
        return new Familia($rs["id"], $rs["numero"], $rs["direccion"], $rs["representante"]);
    }

    public static function familiaCrear(int $numero, string $direccion, string $representante): bool
    {
        return self::ejecutarActualizacion(
            "INSERT INTO Familia (numero,direccion,representante) VALUES(?,?)",
            [$numero, $direccion, $representante]
        );
    }
    private static function familiaActualizarPorID(int $id, int $numero, string $direccion, string $representante): bool
    {
        return self::ejecutarActualizacion(
            "UPDATE Familia SET numero=? direccion=?, representante=? WHERE id=?",
            [$numero, $direccion, $representante, $id]
        );
    }
    public static function familiaObtenerTodas(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Familia",
            []
        );
        foreach ($rs as $familia) {
            $familias = self::FamiliaCrearDesdeRs($familia);
            array_push($datos, $familias);
        }
        return $datos;
    }
    public static function familiaNuevaEntrada(int $id): bool
    {
        return $id == -1;
    }

    public static function familiaFicha($id): Familia
    {
        $nuevaEntrada = self::familiaNuevaEntrada($id);
        if ($nuevaEntrada) {
            $numero = 0;
            $direccion = "<introduzca la direccion >";
            $representante = "<introduzca nombre de representante>";
        } else {
            $rs = self::ejecutarConsulta("SELECT * FROM Familia WHERE id=?", [$id]);
            $numero = $rs[0]["numero"];
            $direccion = $rs[0]["direccion"];
            $representante = $rs[0]["representante"];
        }
        return new Familia($id, $direccion, $representante);
    }

    public static function FamiliaGuardar(int $id, int $numero, string $direccion, string $representante): bool
    {
        $nuevaEntrada = self::familiaNuevaEntrada($id);

        if ($nuevaEntrada) {
            $rs = self::familiaCrear($numero, $direccion, $representante);
            if ($rs) {
                redireccionar("familiaListado.php?creacionCorrecta");
            } else {
                redireccionar("familiaListado.php?creacionIncorrecta");
            }
            return $rs;
        } else {
            $rs = self::familiaActualizarPorID($id, $numero, $direccion, $representante);
            if ($rs) {
                redireccionar("familiaFicha.php?modificacionCorrecta&id=$id");
            } else {
                redireccionar("familiaFicha.php?modificacionIncorrecta&id=$id");
            }
            return $rs;
        }
    }
    public static function familiaEliminarPorID(int $id)
    {
        $rs = self::ejecutarActualizacion(
            "DELETE FROM Familia WHERE id=?",
            [$id]
        );
        if ($rs) {
            redireccionar("familiaListado.php?eliminacionCorrecta");
        } else {
            redireccionar("familiaListado.php?eliminacionIncorrecta");
        }
    }


    /////////////USUARIO///////////////////////////////////////////

    //Esta consulta es especialmente para el inicio de sesion de usuarios
    private static function ejecutarConsultaUsuario(string $sql, array $parametros): array
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $select = self::$pdo->prepare($sql);
        $select->execute($parametros);
        $rs = $select->fetch(PDO::FETCH_ASSOC); //Aqui esta la diferencia a las demás
        if (!$rs) {
            $resultado = [];
        } else {
            $resultado = $rs;
        }
        return $resultado;
    }

    //Creamos el objeto Usuario
    public static function usuarioCrearDesdeRs(array $rs): Usuario
    {
        return new Usuario($rs["id_Usuario"], $rs["identificador"], $rs["email"], $rs["contrasenna"], $rs["tipo"]);
    }

    //Creamos el usuario y lo almacenamos en la base de datos
    public static function usuarioCrear(String $identificador, string $email, String $contrasenna, bool $tipo): bool
    {
        return self::ejecutarActualizacion(
            "INSERT INTO usuario (identificador, email,contrasenna, tipo) VALUES(?,?,?,?)",
            [$identificador, $email, $contrasenna, $tipo]
        );

        // los parametros que obtenemos son los qeu almacenamos en la base de datos
    }

    public static function iniciarSesionUsuario(String $identificador): array
    {
        $datos = [];

        //obtenemos al usaurio desde identificador
        $rs = self::ejecutarConsultaUsuario(
            "SELECT * FROM usuario WHERE identificador=?",
            [$identificador]
        );

        //comprobamos que existe el usuario
        if ($rs) {
            //almacenamos al usaurio en el array datos
            $datos = array($rs["id_Usuario"], $rs["identificador"], $rs["email"], $rs["contrasenna"], $rs["tipo"]);
            //comprobamos el tipo de usuario 
            if ($datos[4] == 1) {
                // si es 1 va a ser administrador
                $_SESSION["tipo"] = 1;
            } else {
                // si es 0 va a ser usuario
                $_SESSION["tipo"] = 0;
            }
        } else
            $datos = [];

        // devolvemos el usuario en array
        return $datos;
    }

    public static function ObtenerSesionIniciada($id): array
    {
        // Aqui obtenemos la sesion y comprobamos que esta iniciada desde el id_usuario que reciboimos
        $datos = [];
        $rs = self::ejecutarConsultaUsuario(
            "SELECT * FROM usuario WHERE id_Usuario=?",
            [$id]
        );
        $datos = array($rs["id_Usuario"], $rs["identificador"], $rs["email"], $rs["contrasenna"], $rs["tipo"]);
        // devolvemos el usuario en array
        return $datos;
    }

    public static function CerrarSesion()
    {
        // funcion que elimina sesion iniciada
        session_start();
        session_unset();
        session_destroy();
    }
}
