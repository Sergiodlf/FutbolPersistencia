<?php
require_once __DIR__ . '/../../persistence/PersistentManager.php';

class GenericDAO
{
    protected $conn;

    // Cuando se crea un DAO se recoge la conexión desde PersistentManager con la base de datos para poder hacer las consultas
    public function __construct()
    {
        $this->conn = PersistentManager::getInstance()->get_connection();
    }
}
