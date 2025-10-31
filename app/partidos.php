<?php
require_once __DIR__ . '/../persistence/DAO/MatchDAO.php';
require_once __DIR__ . '/../persistence/DAO/TeamDAO.php';

$matchDAO = new MatchDAO();
$teamDAO = new TeamDAO();

// Se obtiene el número de jornada, si no hay será la 1, y si es mayor a la máxima jornada posible también
$jornada = intval($_GET['jornada'] ?? 1);
$maxJ = $matchDAO->getMaxJornada();
if ($jornada > $maxJ) $jornada = $maxJ ?: 1;

// Se recogen todos los partidos por jornada y todos los equipos
$matches = $matchDAO->getByJornada($jornada);
$teams = $teamDAO->getAll();
?>

<h2>Partidos - Jornada <?= $jornada ?></h2>

<? // Select para seleccionar la jornada deseada 
?>
<form method="get" action="index.php">
  <input type="hidden" name="page" value="partidos">
  <select name="jornada" onchange="this.form.submit()">
    <?php for ($i = 1; $i <= max($maxJ, 1); $i++): ?>
      <option value="<?= $i ?>" <?= $i == $jornada ? 'selected' : '' ?>>Jornada <?= $i ?></option>
    <?php endfor; ?>
  </select>
</form>

<? // Tabla donde se verá la información de todos los partidos de esa jornada 
?>
<table class="table table-bordered mt-3">
  <tr>
    <th>Local</th>
    <th>Visitante</th>
    <th>Resultado</th>
    <th>Estadio</th>
  </tr>
  <?php foreach ($matches as $m): ?>
    <tr>
      <td><?= $m['home_name'] ?></td>
      <td><?= $m['away_name'] ?></td>
      <td><?= $m['result'] ?></td>
      <td><?= $m['stadium'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<? // Formulario para añadir un nuevo partido 
?>
<h3>Añadir partido</h3>
<form method="post" action="index.php?page=anyadir_partido">
  <div class="row mb-2">
    <? // Selects para seleccionar el equipo local y visitante 
    ?>
    <div class="col"><select name="team_home" class="form-control">
        <option value="">Equipo local</option>
        <?php foreach ($teams as $t): ?>
          <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
        <?php endforeach; ?>
      </select></div>
    <div class="col"><select name="team_away" class="form-control">
        <option value="">Equipo visitante</option>
        <?php foreach ($teams as $t): ?>
          <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
        <?php endforeach; ?>
      </select></div>
  </div>
  <input name="jornada" type="number" class="form-control mb-2" placeholder="Jornada">
  <select name="result" class="form-control mb-2">
    <option value="">Resultado</option>
    <option value="1">1 (Local)</option>
    <option value="X">X (Empate)</option>
    <option value="2">2 (Visitante)</option>
  </select>
  <button class="btn btn-primary">Guardar</button>
</form>