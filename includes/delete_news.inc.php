<?php

// Iniciar a sessão
require_once("../geral.php");
// Incluir a ligação à base de dados
require_once "db.inc.php";
// Incluir o ficheiro das funções
require_once "functions.inc.php";

if (!isset($_SESSION["id"]) && $_SESSION["tipo"] != "admin") {
    header("location: index.php");
    exit();
}

$user_id = $_SESSION['id'];
$news_id = $_GET['news_id'];
$imageToDelete = $_GET["image"];

// Apaga a reunião na base de dados
deleteNews($conn, $news_id, $user_id, $imageToDelete);
