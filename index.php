<?php
// Hacemos require_once de SessionHelper para poder utilizarlo
require_once 'utils/SessionHelper.php';

// Regocemos la página a la que se quiere redirigir
$page = $_GET['page'] ?? null;

// Si no se hace ninguna petición de redirigir a ninguna página:
// Se busca si se ha visitado algún equipo y se redirige a la página para ver los partidos de ese último equipo
// O se redirige de manera predeterminada a la página de equipos
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

// Se hace require_once del header, que también contiene el menú de navegación
require_once 'templates/header.php';

// Se añade la página solicitada
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