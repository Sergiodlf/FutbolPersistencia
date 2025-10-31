<?php
require_once 'GenericDAO.php';

class TeamDAO extends GenericDAO
{

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

    public function getById($id)
    {
        $sql = "SELECT * FROM teams WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function insert($name, $stadium)
    {
        $sql = "INSERT INTO teams (name, stadium) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $name, $stadium);
        return $stmt->execute();
    }

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
