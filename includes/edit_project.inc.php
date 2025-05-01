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
    $project_id = $_POST["project_id"];
    $titulo = mysqli_real_escape_string($conn, $_POST["titulo"]);
    $descricao = mysqli_real_escape_string($conn, $_POST["descricao"]);
    $tecnologia = mysqli_real_escape_string($conn, $_POST["tecnologia"]);
    $tempo_gasto = mysqli_real_escape_string($conn, $_POST["tempo_gasto"]);

    // Se não foi escolhida uma nova imagem para o projeto
    if ($_FILES["image"]["size"] === 0) {

        // Altera o projeto na base de dados
        updateProjectSameImage($conn, $titulo, $descricao, $tecnologia, $tempo_gasto, $project_id, $user_id);

        // Se foi escolhida uma nova imagem para o projeto    
    } else {

        // Upload da imagem
        $projectName = $title;
        $photoName = $_FILES["image"]["name"];
        $photoTmp = $_FILES["image"]["tmp_name"];
        $photoPath = "../projects_img/" . $photoName;

        // Verifica a extensão do arquivo
        $extension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png");

        if (in_array($extension, $allowedExtensions)) {

            // Mover a nova foto para a pasta de destino
            move_uploaded_file($photoTmp, $photoPath);

            // Eliminar a imagem atual
            $deleteImgPath = "../projects_img/" . $_POST["actualImg"];
            unlink($deleteImgPath);

            updateProjectNewImage($conn, $titulo, $photoName, $descricao, $tecnologia, $tempo_gasto, $project_id, $user_id);
        } else {
            header("location: ../edit_project.php?id=" . $user_id . "&project_id=" . $project_id . "&error=invalidformat");
        }
    }
} else {
    header("location: ../index.php");
    exit();
}
