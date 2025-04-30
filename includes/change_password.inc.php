<?php

// Verifica se os dados provêm de um submit

if (isset($_POST["submit"])) {

    // Incluir a ligação à base de dados
    require_once "db.inc.php";
    // Incluir o ficheiro das funções
    require_once "functions.inc.php";

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $current_password = mysqli_real_escape_string($conn, $_POST["current_password"]);
    $new_password = mysqli_real_escape_string($conn, $_POST["new_password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    // Verifica se algum campo não foi preenchido
    if (emptyInputChangePassword($current_password, $new_password, $confirm_password) !== false) {
        header("location: ../change_password.php?error=emptyinput&id=$id&email=$email");
        exit();
    }

    // Verifica se as passwords inseridas são iguais
    if (passwordMatch($new_password, $confirm_password) !== false) {
        header("location: ../change_password.php?error=passwordsdontmatch&id=$id&email=$email");
        exit();
    }

    if (verifyPassword($conn, $current_password, $id) !== false) {
        header("location: ../change_password.php?error=incorrectpassword&id=$id&email=$email");
        exit();
    }

    // Se não houver erros, atualiza a password na base de dados
    updatePassword($conn, $new_password, $id);
} else {
    header("location: ../index.php");
    exit();
}
