<?php
// Creamos un nuevo TeamDAO y sacamos todos los equipos
require_once __DIR__ . '/../persistence/DAO/TeamDAO.php';
$dao = new TeamDAO();
$teams = $dao->getAll();
?>

<h2>Equipos</h2>

<? // Creamos una tabla donde se verá la información de todos los equipos 
?>
<table class="table table-bordered">
  <tr>
    <th>Nombre</th>
    <th>Estadio</th>
    <th>Partidos</th>
  </tr>
  <?php foreach ($teams as $t): ?>
    <tr>
      <td><?= $t['name'] ?></td>
      <td><?= $t['stadium'] ?></td>
      <? // Enlace para ver los partidos de ese equipo 
      ?>
      <td><a href="index.php?page=partidos_de_equipos&team_id=<?= $t['id'] ?>">Ver</a></td>
    </tr>
  <?php endforeach; ?>
</table>

<? // Formulario para añadir un nuevo equipo  
?>
<h3>Añadir nuevo equipo</h3>
<form method="post" action="index.php?page=anyadir_equipo">
  <input name="name" class="form-control mb-2" placeholder="Nombre del equipo">
  <input name="stadium" class="form-control mb-2" placeholder="Estadio">
  <button class="btn btn-primary">Guardar</button>
</form>