<?php
// Clase PersistentManager para conectar con la base de datos
class PersistentManager
{

    private static $instance = null;
    private static $connection = null;

    private $userBD = "";
    private $psswdBD = "";
    private $nameBD = "";
    private $hostBD = "";

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->loadCredentials();
        $this->connect();
    }

    // Se recoge los parámetros de configuración para conectar con la base de datos
    private function loadCredentials()
    {
        $path = __DIR__ . '/conf/credentials.json';
        if (!file_exists($path)) {
            echo "<div class='alert alert-danger'>No se encontró el archivo de configuración de base de datos.</div>";
            exit;
        }

        $cred = json_decode(file_get_contents($path), true);
        $this->hostBD = $cred["host"];
        $this->userBD = $cred["user"];
        $this->psswdBD = $cred["password"];
        $this->nameBD = $cred["name"];
    }

    // Se intenta conectar con la base de datos
    private function connect()
    {
        try {
            self::$connection = new mysqli(
                $this->hostBD,
                $this->userBD,
                $this->psswdBD,
                $this->nameBD
            );
            if (self::$connection->connect_error) {
                throw new Exception(self::$connection->connect_error);
            }
            self::$connection->set_charset("utf8");
        } catch (Exception $exc) {
            echo "<div class='alert alert-danger'>Ha habido un error en la conexión con la BBDD '{$this->nameBD}'.<br>";
            echo "<b>ERROR:</b> " . $exc->getMessage() . "</div>";
            die();
        }
    }

    public function get_connection()
    {
        return self::$connection;
    }
}
