<?php
// Clase SessionHelper con métodos útiles para gestionar SESSIONS
class SessionHelper
{

    // Si no había sesión iniciada para llamar a session_start
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    // Guardamos el el id del último equipo visitado
    public static function setLastViewedTeam($teamId)
    {
        self::start();
        $_SESSION['last_team_id'] = $teamId;
    }

    // Obtenemos el id del último equipo visitado
    public static function getLastViewedTeam()
    {
        self::start();
        return $_SESSION['last_team_id'] ?? null;
    }

    // Limpiamos el last_team_id si hace falta (no se utiliza de momento)
    public static function clearLastViewedTeam()
    {
        self::start();
        unset($_SESSION['last_team_id']);
    }
}
