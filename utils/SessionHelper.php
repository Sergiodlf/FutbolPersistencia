<?php
class SessionHelper {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public static function setLastViewedTeam($teamId) {
        self::start();
        $_SESSION['last_team_id'] = $teamId;
    }

    public static function getLastViewedTeam() {
        self::start();
        return $_SESSION['last_team_id'] ?? null;
    }

    public static function clearLastViewedTeam() {
        self::start();
        unset($_SESSION['last_team_id']);
    }
}
?>
