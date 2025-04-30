<?php

// Iniciar a sessão
require_once("../geral.php");
// Incluir a ligação à base de dados
require_once "db.inc.php";
// Incluir o ficheiro das funções
require_once "functions.inc.php";

// Verifica se os dados provêm de um submit

if (isset($_POST["submit"])) {

    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $apelido = mysqli_real_escape_string($conn, $_POST["apelido"]);
    $dataNascimento = mysqli_real_escape_string($conn, $_POST["dataNascimento"]);
    $telefone = mysqli_real_escape_string($conn, $_POST["telefone"]);
    $id = $_POST["id"];

    if (emptyInputUpdateUser($nome, $apelido, $dataNascimento, $telefone) !== false) {
        header("location: ../edit_profile.php?id=" . $id . "&error=emptyinput");
        exit();
    }

    // Se não houver erros, altera o utilizador na base de dados
    updateUser($conn, $nome, $apelido, $dataNascimento, $telefone, $id);
} else {
    header("location: ../index.php");
    exit();
}
