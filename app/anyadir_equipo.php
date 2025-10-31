<?php
require_once __DIR__ . '/../persistence/DAO/TeamDAO.php';
$name = trim($_POST['name'] ?? '');
$stadium = trim($_POST['stadium'] ?? '');

$dao = new TeamDAO();
// Se crea una array para los errores
$errors = [];

// Comprobamos si el nombre o el estadio está vacío
if ($name === '' || $stadium === '') {
    $errors[] = "Nombre y estadio son obligatorios.";
}
// Comprobamos si ya existía el nombre del equipo
if ($dao->existsByName($name)) {
    $errors[] = "Ya existe un equipo con ese nombre.";
}
// Si hay algún error se imprime y se pone un enlace para volver a la página equipos
if ($errors) {
    foreach ($errors as $e) echo "<div class='alert alert-danger'>$e</div>";
    echo "<a href='index.php?page=equipos'>Volver</a>";
    exit;
}

// Si no hay ningún error se hace un insert del nuevo equipo y se redirige a la página equipos
$dao->insert($name, $stadium);
header("Location: index.php?page=equipos");
exit;
