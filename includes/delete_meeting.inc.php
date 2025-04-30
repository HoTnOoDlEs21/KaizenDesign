<?php

// Iniciar a sessão
require_once("../geral.php");
// Incluir a ligação à base de dados
require_once "db.inc.php";
// Incluir o ficheiro das funções
require_once "functions.inc.php";

// Verifica se já existe um id de sessão, e se é igual ao id do $_GET

if ((isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']) || $_SESSION['tipo'] === "admin") {

    $user_id = $_GET['id'];
    $meeting_id = $_GET['meeting_id'];

    // Se não houver erros, apaga a reunião na base de dados
    deleteMeeting($conn, $meeting_id, $user_id);
} else {
    header("location: ../index.php");
    exit();
}
