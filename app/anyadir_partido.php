<?php
require_once __DIR__ . '/../persistence/DAO/MatchDAO.php';
$dao = new MatchDAO();

$home = intval($_POST['team_home'] ?? 0);
$away = intval($_POST['team_away'] ?? 0);
$jornada = intval($_POST['jornada'] ?? 0);
$result = trim($_POST['result'] ?? '');

$errors = [];

if (!$home || !$away || $home == $away) $errors[] = "Selecciona dos equipos distintos.";
if ($jornada <= 0) $errors[] = "Número de jornada inválido.";
if ($result === '') $errors[] = "Selecciona resultado.";

$numTeams = $dao->countTeams();
if ($numTeams % 2 == 0) {
    $maxJornadas = ($numTeams - 1) * 2;
} else {
    $maxJornadas = $numTeams * 2;
}

if ($jornada > $maxJornadas) {
    $errors[] = "No puede haber más de $maxJornadas jornadas con $numTeams equipos.";
}

if ($dao->existsSameMatch($home, $away)) {
    $errors[] = "Ya se ha jugado este partido con el mismo equipo local y visitante.";
}

if ($dao->teamPlaysThisRound($home, $jornada)) {
    $errors[] = "El equipo local ya tiene un partido en la jornada $jornada.";
}
if ($dao->teamPlaysThisRound($away, $jornada)) {
    $errors[] = "El equipo visitante ya tiene un partido en la jornada $jornada.";
}

if ($errors) {
    foreach ($errors as $e) echo "<div class='alert alert-danger'>$e</div>";
    echo "<a href='index.php?page=partidos'>Volver</a>";
    exit;
}

$stadium = $dao->getTeamStadium($home);
if (!$stadium) $stadium = "Estadio desconocido";

$dao->insert($home, $away, $jornada, $result, $stadium);
header("Location: index.php?page=partidos&jornada=$jornada");
exit;
