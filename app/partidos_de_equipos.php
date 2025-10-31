<?php
require_once __DIR__ . '/../persistence/DAO/MatchDAO.php';
require_once __DIR__ . '/../persistence/DAO/TeamDAO.php';
require_once __DIR__ . '/../utils/SessionHelper.php';

// Se recoge el id del equipo visitado
$teamId = intval($_GET['team_id'] ?? 0);
$teamDAO = new TeamDAO();
$matchDAO = new MatchDAO();

// Se recoge el equipo
$team = $teamDAO->getById($teamId);
if (!$team) {
  echo "<div class='alert alert-danger'>Equipo no encontrado.</div>";
  exit;
}

// Guardamos el id como último equipo visitado
SessionHelper::setLastViewedTeam($teamId);
// Se recogen todos los partidos del equipo
$matches = $matchDAO->getByTeam($teamId);
?>

<h2>Partidos de <?= ($team['name']) ?></h2>

<? // Tabla donde se verá la información de todos los partidos del equipo 
?>
<table class="table table-striped">
  <tr>
    <th>Local</th>
    <th>Visitante</th>
    <th>Jornada</th>
    <th>Resultado</th>
    <th>Estadio</th>
  </tr>
  <?php foreach ($matches as $m): ?>
    <tr>
      <td><?= $m['home_name'] ?></td>
      <td><?= $m['away_name'] ?></td>
      <td><?= $m['jornada'] ?></td>
      <td><?= $m['result'] ?></td>
      <td><?= $m['stadium'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>