<?php
require_once __DIR__ . '/../persistence/DAO/MatchDAO.php';
$dao = new MatchDAO();

$home = intval($_POST['team_home'] ?? 0);
$away = intval($_POST['team_away'] ?? 0);
$jornada = intval($_POST['jornada'] ?? 0);
$result = trim($_POST['result'] ?? '');
// Se crea una array para los errores
$errors = [];

// Comprobamos si hay algún campo vacío o si es el mismo equipo
if (!$home || !$away || $home == $away) $errors[] = "Selecciona dos equipos distintos.";
if ($result === '') $errors[] = "Selecciona resultado.";
// Comprobamos si la jornada es menor a 1
if ($jornada <= 0) $errors[] = "Número de jornada inválido.";

// Recogemos la cantidad de equipos para saber el máximo de jornadas posibles (diferente si hay equipos pares o impares)
$numTeams = $dao->countTeams();
if ($numTeams % 2 == 0) {
    $maxJornadas = ($numTeams - 1) * 2;
} else {
    $maxJornadas = $numTeams * 2;
}
// Comprobamos si la jornada es mayor a la máxima posible
if ($jornada > $maxJornadas) {
    $errors[] = "No puede haber más de $maxJornadas jornadas con $numTeams equipos.";
}
// Comprobamos si ya se ha jugado el mismo partido (mismo local y mismo visitante)
if ($dao->existsSameMatch($home, $away)) {
    $errors[] = "Ya se ha jugado este partido con el mismo equipo local y visitante.";
}
// Comprobamos si algún equipo ya ha jugado en esa jornada
if ($dao->teamPlaysThisRound($home, $jornada)) {
    $errors[] = "El equipo local ya tiene un partido en la jornada $jornada.";
}
if ($dao->teamPlaysThisRound($away, $jornada)) {
    $errors[] = "El equipo visitante ya tiene un partido en la jornada $jornada.";
}
// Si hay algún error se imprime
if ($errors) {
    foreach ($errors as $e) echo "<div class='alert alert-danger'>$e</div>";
    echo "<a href='index.php?page=partidos'>Volver</a>";
    exit;
}
// Si no hay ningún error se recoge el estadio del equipo local y se hace el insert del nuevo partido
$stadium = $dao->getTeamStadium($home);
if (!$stadium) $stadium = "Estadio desconocido";

$dao->insert($home, $away, $jornada, $result, $stadium);
header("Location: index.php?page=partidos&jornada=$jornada");
exit;
