<?php
require_once __DIR__ . '/../../persistence/PersistentManager.php';

class GenericDAO
{
    protected $conn;

    public function __construct()
    {
        $this->conn = PersistentManager::getInstance()->get_connection();
    }
}
