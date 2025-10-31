<?php
require_once 'GenericDAO.php';

// Clase para hacer las consultas de los equipos a la base de datos que extiende de GenericDAO
class TeamDAO extends GenericDAO
{

    // Consulta para obtener todos los equipos
    public function getAll()
    {
        $query = "SELECT * FROM teams ORDER BY name";
        $result = mysqli_query($this->conn, $query);
        $teams = [];
        while ($team = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($teams, $team);
        }
        return $teams;
    }

    // Consulta para obtener un equipo por su id
    public function getById($id)
    {
        $sql = "SELECT * FROM teams WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    // Consulta para insertar un nuevo equipo, con nombre y estadio
    public function insert($name, $stadium)
    {
        $sql = "INSERT INTO teams (name, stadium) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $name, $stadium);
        return $stmt->execute();
    }

    // Consulta para comprobar si existe un equipo con un nombre
    public function existsByName($name)
    {
        $sql = "SELECT COUNT(*) as c FROM teams WHERE name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        return $res['c'] > 0;
    }
}
