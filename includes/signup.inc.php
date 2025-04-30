<?php

// Verifica se os dados provêm de um submit

if (isset($_POST["submit"])) {

    // Incluir a ligação à base de dados
    require_once "db.inc.php";
    // Incluir o ficheiro das funções
    require_once "functions.inc.php";

    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $apelido = mysqli_real_escape_string($conn, $_POST["apelido"]);
    $dataNascimento = mysqli_real_escape_string($conn, $_POST["dataNascimento"]);
    $telefone = mysqli_real_escape_string($conn, $_POST["telefone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $senha = mysqli_real_escape_string($conn, $_POST["senha"]);
    $passwordrepeat = mysqli_real_escape_string($conn, $_POST["passwordrepeat"]);
    $tipo = "cliente";

    // Verifica se algum campo não foi preenchido
    if (emptyInputSignup($nome, $apelido, $dataNascimento, $telefone, $email, $senha, $passwordrepeat) !== false) {
        header("location: ../signup.php?error=emptyinput&email=$email&nome=$nome&apelido=$apelido&dataNascimento=$dataNascimento&telefone=$telefone");
        exit();
    }

    // Verifica se o email inserido é válido
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail&email=$email&nome=$nome&apelido=$apelido&dataNascimento=$dataNascimento&telefone=$telefone");
        exit();
    }

    // Verifica se as passwords inseridas são iguais
    if (passwordMatch($senha, $passwordrepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch&email=$email&nome=$nome&apelido=$apelido&dataNascimento=$dataNascimento&telefone=$telefone");
        exit();
    }

    // Verifica se o email introduzido já existe
    if (emailExists($conn, $email) !== false) {
        header("location: ../signup.php?error=emailtaken&email=$email&nome=$nome&apelido=$apelido&dataNascimento=$dataNascimento&telefone=$telefone");
        exit();
    }

    // Verifica se o número de telefone é válido
    if (invalidPhone($telefone) !== false) {
        header("location: ../signup.php?error=invalidphone&email=$email&nome=$nome&apelido=$apelido&dataNascimento=$dataNascimento&telefone=$telefone");
        exit();
    }

    // Se não houver erros, cria um utilizador na base de dados
    createUser($conn, $nome, $apelido, $dataNascimento, $telefone, $email, $senha, $tipo);
} else {
    header("location: ../signup.php");
    exit();
}
