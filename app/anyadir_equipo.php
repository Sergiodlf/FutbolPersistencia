<?php
require_once __DIR__ . '/../persistence/DAO/TeamDAO.php';
$name = trim($_POST['name'] ?? '');
$stadium = trim($_POST['stadium'] ?? '');

$dao = new TeamDAO();
$errors = [];

if ($name === '' || $stadium === '') {
    $errors[] = "Nombre y estadio son obligatorios.";
}
if ($dao->existsByName($name)) {
    $errors[] = "Ya existe un equipo con ese nombre.";
}

if ($errors) {
    foreach ($errors as $e) echo "<div class='alert alert-danger'>$e</div>";
    echo "<a href='index.php?page=equipos'>Volver</a>";
    exit;
}

$dao->insert($name, $stadium);
header("Location: index.php?page=equipos");
exit;
