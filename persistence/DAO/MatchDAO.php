<?php
require_once 'GenericDAO.php';

class MatchDAO extends GenericDAO
{

    public function getByJornada($jornada)
    {
        $sql = "
            SELECT m.*, th.name AS home_name, ta.name AS away_name
            FROM matches m
            JOIN teams th ON th.id = m.team_home_id
            JOIN teams ta ON ta.id = m.team_away_id
            WHERE jornada = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $jornada);
        $stmt->execute();
        $res = $stmt->get_result();
        $matches = [];
        while ($m = $res->fetch_assoc()) $matches[] = $m;
        return $matches;
    }

    public function getByTeam($teamId)
    {
        $sql = "
            SELECT m.*, th.name AS home_name, ta.name AS away_name
            FROM matches m
            JOIN teams th ON th.id = m.team_home_id
            JOIN teams ta ON ta.id = m.team_away_id
            WHERE team_home_id = ? OR team_away_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $teamId, $teamId);
        $stmt->execute();
        $res = $stmt->get_result();
        $matches = [];
        while ($m = $res->fetch_assoc()) $matches[] = $m;
        return $matches;
    }

    public function existsSameMatch($home, $away)
    {
        $sql = "SELECT COUNT(*) AS c 
            FROM matches 
            WHERE team_home_id = ? AND team_away_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $home, $away);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        return $res['c'] > 0;
    }

    public function teamPlaysThisRound($teamId, $jornada)
    {
        $sql = "SELECT COUNT(*) AS c FROM matches 
                WHERE jornada = ? 
                AND (team_home_id = ? OR team_away_id = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $jornada, $teamId, $teamId);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        return $res['c'] > 0;
    }

    public function getTeamStadium($teamId)
    {
        $sql = "SELECT stadium FROM teams WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $teamId);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        return $res ? $res['stadium'] : null;
    }

    public function insert($home, $away, $jornada, $result, $stadium)
    {
        $sql = "INSERT INTO matches (team_home_id, team_away_id, jornada, result, stadium)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiiss", $home, $away, $jornada, $result, $stadium);
        return $stmt->execute();
    }

    public function getMaxJornada()
    {
        $result = mysqli_query($this->conn, "SELECT MAX(jornada) AS mj FROM matches");
        $row = mysqli_fetch_assoc($result);
        return $row ? intval($row['mj']) : 0;
    }

    public function countTeams()
    {
        $res = mysqli_query($this->conn, "SELECT COUNT(*) AS c FROM teams");
        $row = mysqli_fetch_assoc($res);
        return $row ? intval($row['c']) : 0;
    }
}
