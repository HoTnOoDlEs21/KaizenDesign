<?php

// Iniciar a sessão
require_once("geral.php");
// Incluir a ligação à base de dados
require_once "includes/db.inc.php";

if (isset($_GET['newsId'])) {

    $newsId = $_GET['newsId'];

    // Consulta para buscar os detalhes da notícia com base no ID
    $sql = "SELECT titulo, conteudo, imagem, data_publicacao FROM noticias WHERE id = $newsId;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $titulo = $row['titulo'];
        $conteudo = $row['conteudo'];
        $imagem = $row['imagem'];
        $data_publicacao = $row['data_publicacao'];

        // Exibe os detalhes da notícia
        echo "<div id='selectedNewsBox' class='col-10 mx-auto'>";
        echo "<div class='row'>";
        echo "<div class='col-4'>";
        echo "<img class='' src='news_img/" . $imagem . "' width='100%' alt='image'>";
        echo "</div>";
        echo "<div class='col-8 d-flex flex-column justify-content-around'>";
        echo "<h3>" . $titulo . "</h3>";
        echo "<p>" . $conteudo . "</p>";
        echo "<p>Data da notícia: " . $data_publicacao . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "Nenhuma notícia encontrada com o ID fornecido.";
    }
} else {
    header("location: index.php");
    exit();
}
