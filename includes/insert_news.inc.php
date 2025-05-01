<?php

// Iniciar a sessão
require_once("../geral.php");

// Permitir o acesso apenas aos admins
if (!isset($_SESSION["id"]) && $_SESSION["tipo"] != "admin") {
    header("location: index.php");
    exit();
}

// Ligação à base de dados
require_once("../includes/db.inc.php");

// Verifica se os dados provêm de um POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar os dados do formulário
    $titulo = mysqli_real_escape_string($conn, $_POST["titulo"]);
    $conteudo = mysqli_real_escape_string($conn, $_POST["conteudo"]);

    // Upload da imagem
    $newsName = $titulo;
    $photoName = $_FILES["image"]["name"];
    $photoTmp = $_FILES["image"]["tmp_name"];
    $photoPath = "../news_img/" . $photoName;

    // Verifica a extensão do arquivo
    $extension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
    $allowedExtensions = array("jpg", "jpeg", "png");

    if (in_array($extension, $allowedExtensions)) {
        // Mover a foto para a pasta de destino
        move_uploaded_file($photoTmp, $photoPath);

        // Inserir os dados na tabela projects
        $sql = "INSERT INTO noticias (titulo, imagem, conteudo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $titulo, $photoName, $conteudo);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("location: ../news.php?id=" . $_SESSION['id'] . "&error=noneInsertNewsSuccess"); // Redirecionar de volta para a página de gestão de notícias
            exit();
        } else {
            $stmt->close();
            $conn->close();
            header("location: ../news.php?id=" . $_SESSION['id'] . "&error=insertfailed"); // Redirecionar com mensagem de erro
            exit();
        }
    } else {
        header("location: ../news.php?id=" . $_SESSION['id'] . "&error=invalidformat");
    }
} else {
    header("location: ../index.php");
    exit();
}
