<?php

    // Verifica se os dados provêm de um submit

    if (isset($_POST["submit"])) {
        
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        // Incluir a ligação à base de dados
        require_once "db.inc.php";
        // Incluir o ficheiro das funções
        require_once "functions.inc.php";

        // Verifica se algum campo não foi preenchido
        if (emptyInputLogin($email, $senha) !== false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        if (!emailExists($conn, $email)) {
            header("location: ../login.php?error=emailnotexist");
            exit();
        }

        loginUser($conn, $email, $senha);

    } else {
        header("location: ../login.php");
        exit();
    }