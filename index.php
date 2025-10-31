<?php
require_once 'utils/SessionHelper.php';

$page = $_GET['page'] ?? null;

if (!$page) {
    $ultimVisitada = SessionHelper::getLastViewedTeam();
    if ($ultimVisitada) {
        header("Location: index.php?page=partidos_de_equipos&team_id={$ultimVisitada}");
        exit;
    } else {
        header("Location: index.php?page=equipos");
        exit;
    }
}

require_once 'templates/header.php';

switch ($page) {
    case 'equipos':
        include 'app/equipos.php';
        break;
    case 'partidos_de_equipos':
        include 'app/partidos_de_equipos.php';
        break;
    case 'partidos':
        include 'app/partidos.php';
        break;
    case 'anyadir_equipo':
        include 'app/anyadir_equipo.php';
        break;
    case 'anyadir_partido':
        include 'app/anyadir_partido.php';
        break;
    default:
        echo "<h3>Página no encontrada</h3>";
}

include 'templates/footer.php';
?>

<link rel="stylesheet" href=".\assets\css\bootstrap.css">