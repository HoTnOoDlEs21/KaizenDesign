<?php

// Iniciar a sessão
require_once("../geral.php");

// Permitir o acesso apenas aos admins
if (!isset($_SESSION["id"]) && $_SESSION["tipo"] != "admin") {
    header("location: index.php");
    exit();
}

// Ligação à base de dados
require_once("db.inc.php");

// Verifica se os dados provêm de um POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar os dados do formulário
    $titulo = mysqli_real_escape_string($conn, $_POST["titulo"]);
    $descricao = mysqli_real_escape_string($conn, $_POST["descricao"]);
    $tecnologia = mysqli_real_escape_string($conn, $_POST["tecnologia"]);
    $tempo_gasto = mysqli_real_escape_string($conn, $_POST["tempo_gasto"]);

    // Upload da imagem
    $projectName = $titulo;
    $photoName = $_FILES["image"]["name"];
    $photoTmp = $_FILES["image"]["tmp_name"];
    $photoPath = "../projects_img/" . $photoName;

    // Verifica a extensão do arquivo
    $extension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
    $allowedExtensions = array("jpg", "jpeg", "png");

    if (in_array($extension, $allowedExtensions)) {
        // Mover a foto para a pasta de destino
        move_uploaded_file($photoTmp, $photoPath);

        // Inserir os dados na tabela projects
        $sql = "INSERT INTO projetos (titulo, imagem, descricao, tecnologia, tempo_gasto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $titulo, $photoName, $descricao, $tecnologia, $tempo_gasto);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("location: ../projects.php?id=" . $_SESSION['id'] . "&error=noneInsertProjectSuccess"); // Redirecionar de volta para a página de gestão de projetos
            exit();
        } else {
            $stmt->close();
            $conn->close();
            header("location: ../projects.php?id=" . $_SESSION['id'] . "&error=insertfailed"); // Redirecionar com mensagem de erro
            exit();
        }
    } else {
        header("location: ../projects.php?id=" . $_SESSION['id'] . "&error=invalidformat");
    }
} else {
    header("location: ../index.php");
    exit();
}
