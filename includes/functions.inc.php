<?php

// SIGN UP FUNCTIONS

function emptyInputSignup($nome, $apelido, $dataNascimento, $telefone, $email, $senha, $passwordrepeat)
{
    $result;
    if (empty($nome) || empty($apelido) || empty($dataNascimento) || empty($telefone) || empty($email) || empty($senha) || empty($passwordrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function passwordMatch($senha, $passwordrepeat)
{
    $result;
    if ($senha !== $passwordrepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emailExists($conn, $email)
{

    $stmt = $conn->prepare("SELECT * FROM utilizadores WHERE email = ?;");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultData = $stmt->get_result();

    if ($row = $resultData->fetch_row()) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    $stmt->close();
}

function invalidPhone($telefone)
{
    // Remove espaços e traços do telefone
    $telefone = str_replace([' ', '-'], '', $telefone);

    // Verifica se é composto apenas por 9 dígitos
    if (preg_match('/^[0-9]{9}$/', $telefone)) {
        return false; // Está válido
    } else {
        return true; // Está inválido
    }
}

function createUser($conn, $nome, $apelido, $dataNascimento, $telefone, $email, $senha, $tipo)
{

    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO utilizadores (nome, apelido, dataNascimento, telefone, email, senha, tipo) VALUES (?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param("sssssss", $nome, $apelido, $dataNascimento, $telefone, $email, $hashedPassword, $tipo);
    $stmt->execute();
    $stmt->close();

    // LOGIN AUTOMÁTICO
    session_start();

    $stmt = $conn->prepare("SELECT id FROM utilizadores WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    $_SESSION["id"] = $user["id"];
    $_SESSION["nome"] = $nome;
    $_SESSION["apelido"] = $apelido;
    $_SESSION["dataNascimento"] = $dataNascimento;
    $_SESSION["telefone"] = $telefone;
    $_SESSION["email"] = $email;
    $_SESSION["tipo"] = $tipo;

    if ($tipo === "admin") {
        header("location: ../dashboard_admin.php?id=" . $user["id"]);
        exit();
    } else if ($tipo === "user") {
        header("location: ../profile_user.php?id=" . $user["id"]);
        exit();
    } else {
        header("location: ../index.php");
        exit();
    }
}

// LOGIN FUNCTIONS

function emptyInputLogin($email, $senha)
{
    $result;
    if (empty($email) || empty($senha)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $email, $senha)
{
    $stmt = $conn->prepare("SELECT * FROM utilizadores WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 1) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $userFound = $result->fetch_assoc();
    $stmt->close();

    $passwordHashed = $userFound["senha"];
    $checkPassword = password_verify($senha, $passwordHashed);

    if ($checkPassword === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    } else {
        session_start();
        $_SESSION["id"] = $userFound["id"];
        $_SESSION["nome"] = $userFound["nome"];
        $_SESSION["apelido"] = $userFound["apelido"];
        $_SESSION["dataNascimento"] = $userFound["dataNascimento"];
        $_SESSION["telefone"] = $userFound["telefone"];
        $_SESSION["email"] = $userFound["email"];
        $_SESSION["tipo"] = $userFound["tipo"];

        // Redirecionar consoante o tipo de utilizador
        if ($_SESSION["tipo"] === "admin") {
            header("location: ../dashboard_admin.php?id=" . $_SESSION['id']);
            exit();
        } else if ($_SESSION["tipo"] === "cliente") {
            header("location: ../profile_user.php?id=" . $_SESSION['id']);
            exit();
        } else {
            header("location: ../index.php");
            exit();
        }
    }
}


// CHANGE PASSWORD FUNCTIONS

function emptyInputChangePassword($current_password, $new_password, $confirm_password)
{
    $result;
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function verifyPassword($conn, $current_password, $id)
{

    $stmt = $conn->prepare("SELECT * FROM utilizadores WHERE id = ?;");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se não retornar resultados, dá mensagem de erro
    if ($result->num_rows != 1) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $userFound = $result->fetch_assoc();

    $stmt->close();

    // Verifica se a password bate certo com a hashed
    $passwordHashed = $userFound["senha"];
    $checkPassword = password_verify($current_password, $passwordHashed);

    if ($checkPassword) {
        return false;
    } else {
        return true;
    }
}

function updatePassword($conn, $new_password, $id)
{

    $HashedNewPassword = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE utilizadores SET senha = ? WHERE id = ?;");
    $stmt->bind_param("si", $HashedNewPassword, $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("location: ../change_password.php?id=" . $id . "&error=nonePasswordUpdated");
        exit();
    } else {
        $stmt->close();
        header("location: ../change_password.php?id=" . $id . "error=stmtfailed");
        exit();
    }
}

// UPDATE PROFILE FUNCTIONS

function updateUser($conn, $nome, $apelido, $dataNascimento, $telefone, $id)
{

    $stmt = $conn->prepare("UPDATE utilizadores SET nome = ?, apelido = ?, dataNascimento = ?, telefone = ? WHERE id = ?;");
    $stmt->bind_param("ssssi", $nome, $apelido, $dataNascimento, $telefone, $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("location: ../edit_profile.php?id=" . $id . "&error=none");
        exit();
    } else {
        $stmt->close();
        header("location: ../edit_profile.php?id=" . $id . "error=stmtfailed");
        exit();
    }
}

function emptyInputUpdateUser($nome, $apelido, $dataNascimento, $telefone)
{
    $result;
    if (empty($nome) || empty($apelido) || empty($dataNascimento) || empty($telefone)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// MEETING FUNCTIONS

function createMeeting($conn, $data, $hora, $observacoes, $user_id)
{

    $stmt = $conn->prepare("INSERT INTO marcacoes (data, hora, observacoes, utilizador_id) VALUES (?, ?, ?, ?);");
    $stmt->bind_param("sssi", $data, $hora, $observacoes, $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("location: ../profile_user.php?id=" . $user_id . "&error=noneMeetingCreated");
        exit();
    } else {
        $stmt->close();
        header("location: ../profile_user.php?id=" . $user_id . "&error=meetingError");
        exit();
    }
}

function emptyInputCreateMeeting($data, $hora, $observacoes)
{
    $result;
    if (empty($data) || empty($hora) || empty($observacoes)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyInputUpdateMeeting($data, $hora, $observacoes)
{
    $result;
    if (empty($data) || empty($hora) || empty($observacoes)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function updateMeeting($conn, $data, $hora, $observacoes, $meeting_id, $user_id)
{

    $stmt = $conn->prepare("UPDATE marcacoes SET data = ?, hora = ?, observacoes = ? WHERE id = ? AND utilizador_id = ?;");
    $stmt->bind_param("sssii", $data, $hora, $observacoes, $meeting_id, $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("location: ../edit_meeting.php?id=" . $user_id . "&meeting_id=" . $meeting_id . "&error=none");
        exit();
    } else {
        $stmt->close();
        header("location: ../edit_meeting.php?id=" . $user_id . "&meeting_id=" . $meeting_id . "&error=stmtfailed");
        exit();
    }
}

function deleteMeeting($conn, $meeting_id, $user_id)
{

    $stmt = $conn->prepare("DELETE FROM marcacoes WHERE id = ?;");
    $stmt->bind_param("i", $meeting_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("location: ../profile_user.php?id=" . $user_id);
        exit();
    } else {
        $stmt->close();
        header("location: ../profile_user.php?id=" . $user_id . "&error=DeletingError");
        exit();
    }
}

// PROJECTS FUNCTIONS

function updateProjectSameImage($conn, $titulo, $descricao, $tecnologia, $tempo_gasto, $project_id, $user_id)
{

    $stmt = $conn->prepare("UPDATE projetos SET titulo = ?, descricao = ?, tecnologia = ?, tempo_gasto = ? WHERE id = ?;");
    $stmt->bind_param("sssii", $titulo, $descricao, $tecnologia, $tempo_gasto, $project_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("location: ../edit_project.php?id=" . $user_id . "&project_id=" . $project_id . "&error=none");
        exit();
    } else {
        $stmt->close();
        header("location: ../edit_project.php?id=" . $user_id . "&project_id=" . $project_id . "&error=stmtfailed");
        exit();
    }
}

function updateProjectNewImage($conn, $titulo, $descricao, $tecnologia, $tempo_gasto, $project_id, $user_id)
{

    $stmt = $conn->prepare("UPDATE projetos SET titulo = ?, descricao = ?, tecnologia = ?, tempo_gasto = ? WHERE id = ?;");
    $stmt->bind_param("sssii", $titulo, $descricao, $tecnologia, $tempo_gasto, $project_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("location: ../edit_project.php?id=" . $user_id . "&project_id=" . $project_id . "&error=none");
        exit();
    } else {
        $stmt->close();
        header("location: ../edit_project.php?id=" . $user_id . "&project_id=" . $project_id . "&error=stmtfailed");
        exit();
    }
}

function deleteProject($conn, $project_id, $user_id, $imageToDelete)
{

    $deleteImgPath = "../projects_img/" . $imageToDelete;

    $stmt = $conn->prepare("DELETE FROM projetos WHERE id = ?;");
    $stmt->bind_param("i", $project_id);

    if ($stmt->execute()) {
        $stmt->close();
        unlink($deleteImgPath);
        header("location: ../projects.php?id=" . $user_id . "&error=DeleteSuccess");
        exit();
    } else {
        $stmt->close();
        header("location: ../projects.php?id=" . $user_id . "&error=DeletingError");
        exit();
    }
}


// NEWS FUNCTIONS

function updateNewsSameImage($conn, $titulo, $conteudo, $news_id, $user_id)
{

    $stmt = $conn->prepare("UPDATE noticias SET titulo = ?, conteudo = ? WHERE id = ?;");
    $stmt->bind_param("ssi", $titulo, $conteudo, $news_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("location: ../edit_news.php?id=" . $user_id . "&news_id=" . $news_id . "&error=none");
        exit();
    } else {
        $stmt->close();
        header("location: ../edit_news.php?id=" . $user_id . "&news_id=" . $news_id . "&error=stmtfailed");
        exit();
    }
}

function updateNewsNewImage($conn, $titulo, $photoName, $conteudo, $news_id, $user_id)
{

    $stmt = $conn->prepare("UPDATE noticias SET titulo = ?, conteudo = ? WHERE id = ?;");
    $stmt->bind_param("sssi", $titulo, $photoName, $conteudo, $news_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("location: ../edit_news.php?id=" . $user_id . "&news_id=" . $news_id . "&error=none");
        exit();
    } else {
        $stmt->close();
        header("location: ../edit_news.php?id=" . $user_id . "&news_id=" . $news_id . "&error=stmtfailed");
        exit();
    }
}

function deleteNews($conn, $news_id, $user_id, $imageToDelete)
{

    $deleteImgPath = "../news_img/" . $imageToDelete;

    $stmt = $conn->prepare("DELETE FROM noticias WHERE id = ?;");
    $stmt->bind_param("i", $news_id);

    if ($stmt->execute()) {
        $stmt->close();
        unlink($deleteImgPath);
        header("location: ../news.php?id=" . $user_id . "&error=DeleteSuccess");
        exit();
    } else {
        $stmt->close();
        header("location: ../news.php?id=" . $user_id . "&error=DeletingError");
        exit();
    }
}
