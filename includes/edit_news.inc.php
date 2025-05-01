<?php

// Iniciar a sessão
require_once("../geral.php");
// Ligação à base de dados
require_once("db.inc.php");
// Incluir o ficheiro das funções
require_once "functions.inc.php";

// Permitir o acesso apenas aos admins
if (!isset($_SESSION["id"]) && $_SESSION["tipo"] != "admin") {
    header("location: index.php");
    exit();
}

// Verifica se os dados provêm de um POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar os dados do formulário
    $user_id = $_POST["id"];
    $news_id = $_POST["news_id"];
    $titulo = mysqli_real_escape_string($conn, $_POST["titulo"]);
    $conteudo = mysqli_real_escape_string($conn, $_POST["conteudo"]);

    // Se não foi escolhida uma nova imagem para o projeto
    if ($_FILES["imagem"]["size"] === 0) {

        // Altera o projeto na base de dados
        updateNewsSameImage($conn, $titulo, $conteudo, $news_id, $user_id);

        // Se foi escolhida uma nova imagem para o projeto    
    } else {

        // Upload da imagem
        $NewsName = $titulo;
        $photoName = $_FILES["imagem"]["nome"];
        $photoTmp = $_FILES["imagem"]["tmp_name"];
        $photoPath = "../news_img/" . $photoName;

        // Verifica a extensão do arquivo
        $extension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png");

        if (in_array($extension, $allowedExtensions)) {

            // Mover a nova foto para a pasta de destino
            move_uploaded_file($photoTmp, $photoPath);

            // Eliminar a imagem atual
            $deleteImgPath = "../news_img/" . $_POST["actualImg"];
            unlink($deleteImgPath);

            updateNewsNewImage($conn, $titulo, $photoName, $conteudo, $news_id, $user_id);
        } else {
            header("location: ../edit_news.php?id=" . $user_id . "&news_id=" . $news_id . "&error=invalidformat");
        }
    }
} else {
    header("location: ../index.php");
    exit();
}
