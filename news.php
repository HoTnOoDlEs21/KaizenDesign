<?php

// Incluir o link da raiz do projeto e iniciar sessão
require_once("geral.php");

if (!isset($_SESSION["id"]) && $_SESSION["tipo"] != "admin") {
    header("location: index.php");
    exit();
}

// Ligação à base de dados
require_once("includes/db.inc.php");

// Obter o ID do usuário da sessão
$user_id = $_SESSION["id"];

// ----- UTILIZADOR -----

// Usar prepared statement para ir buscar os dados do utilizador
$stmt = $conn->prepare("SELECT nome, apelido, dataNascimento, telefone, email, tipo FROM utilizadores WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nome, $apelido, $dataNascimento, $telefone, $email, $tipo);
$stmt->fetch();

// Criar um objeto da classe User com os dados do utilizador
require_once("models/User.php");
$utilizador = new User($user_id, $nome, $apelido, $dataNascimento, $telefone, $email, $tipo);
$user = $utilizador;

// Fechar o prepared statement e a ligação com a base de dados
$stmt->close();

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="José Gonçalves" />
    <meta
        name="description"
        content="KaizenDesign - Empresa de criação de websites. Conheça um pouco do nosso trabalho e peça um orçamento à medida do seu projeto." />
    <meta name="keywords" content="website, projeto, portfólio, webdesign" />
    <link rel="shortcut icon" href="KaizenDesign.ico" type="image/x-icon" />
    <title>KaizenDesign- Criação de Websites</title>

    <!-- Font Awesome -->
    <script
        src="https://kit.fontawesome.com/265e8c9848.js"
        crossorigin="anonymous"></script>

    <!-- Bootstrap’s CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous" />

    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/style.css?v=1.0" />

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <?php
    // Inclui o header
    require_once("templates/header.php");
    ?>

    <!----Navbar---->
    <nav class="navbar navbar-custom sticky-top navbar-light navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="<?= $BASE_URL ?>">
                <img
                    src="<?= $BASE_URL ?>/images/KaizenDesignName.png"
                    alt="Kaizen_logo"
                    width="210"
                    height="25"
                    class="d-inline-block align-text-top" />
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $BASE_URL ?>/index.php">Home</a>
                    </li>
                    <li class="nav-item ps-0 ps-lg-3">
                        <a class="nav-link" href="<?= $BASE_URL ?>/portfolio.php">Portfólio</a>
                    </li>
                    <li class="nav-item ps-0 ps-lg-3">
                        <a class="nav-link" href="<?= $BASE_URL ?>/orcamento.php">Pedido de Orçamento</a>
                    </li>
                    <li class="nav-item ps-0 ps-lg-3">
                        <a class="nav-link" href="<?= $BASE_URL ?>/contactos.php">Contactos</a>
                    </li>
                    <?php
                    // Se estiver logado, aparece o item Profile e o item Logout na Navbar
                    if (isset($_SESSION["email"])) {
                        if ($_SESSION["tipo"] === "admin") {
                            echo '<li class="nav-item ps-0 ps-lg-3"><a class="nav-link active" href="' . $BASE_URL . '/dashboard_admin.php?id=' . $_SESSION['id'] . '"><i class="fa-solid fa-user"></i> Olá, ' . htmlspecialchars($_SESSION["nome"]) . '</a></li>';
                        } else if ($_SESSION["tipo"] === "cliente") {
                            echo '<li class="nav-item ps-0 ps-lg-3"><a class="nav-link active" href="' . $BASE_URL . '/profile_user.php?id=' . $_SESSION['id'] . '"><i class="fa-solid fa-user"></i> Olá, ' . htmlspecialchars($_SESSION["nome"]) . '</a></li>';
                        }
                        echo '<li class="nav-item ps-0 ps-lg-3"><a class="nav-link" href="' . $BASE_URL . '/includes/logout.inc.php">Logout</a></li>';
                    } else {
                        // Se não estiver logado, aparece o item Login/Registo na Navbar
                        echo '<li class="nav-item ps-0 ps-lg-3"><a class="nav-link" href="' . $BASE_URL . '/login.php"><i class="fa-solid fa-user"></i> Login/Registo</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main class="container py-5">
        <div class="row">
            <div class="col-12">
                <div id="profile-name" class="mt-2 mb-5">
                    <h2><?= $user->getFullName(); ?></h2>
                    <h4>Administrador</h4>
                    <hr>
                </div>

                <?php

                if (isset($_GET["error"])) {

                    // Sistema de mensagens
                    if ($_GET["error"]  == "noneInsertNewsSuccess") {
                        echo "<div class='alert alert-success text-center col-6 mx-auto mb-5' role='alert'>Notícia adicionada com sucesso!</div>";
                    } else if ($_GET["error"]  == "insertfailed") {
                        echo "<div class='alert alert-danger text-center col-6 mx-auto mb-5' role='alert'>Erro ao adicionar a notícia.</div>";
                    } else if ($_GET["error"]  == "invalidformat") {
                        echo "<div class='alert alert-danger text-center col-6 mx-auto mb-5' role='alert'>Formato de arquivo não permitido. Apenas arquivos JPG, JPEG e PNG são aceites.</div>";
                    } else if ($_GET["error"]  == "DeleteSuccess") {
                        echo "<div class='alert alert-success text-center col-6 mx-auto mb-5' role='alert'>Notícia eliminada com sucesso!</div>";
                    } else if ($_GET["error"]  == "DeletingError") {
                        echo "<div class='alert alert-danger text-center col-6 mx-auto mb-5' role='alert'>Não foi possível eliminar a notícia!</div>";
                    }
                }

                ?>

                <div class="row">
                    <div id="news-box" class="col col-xl-10 mx-auto">
                        <h4 class="news-box-label mb-4">Notícias</h4>

                        <!-- Tabela com lista de projetos realizados -->
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-fixed" id="news-table">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col" class="d-none d-lg-table-cell">Imagem</th>
                                        <th scope="col" class="d-table-cell">Título</th>
                                        <th scope="col" class="d-table-cell">Conteúdo</th>
                                        <th scope="col" class="d-table-cell">Publicação</th>
                                        <th scope="col" class="d-table-cell text-center">Editar</th>
                                        <th scope="col" class="d-table-cell text-center">Apagar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    // Consulta SQL para obter os dados da noticia
                                    $sql = "SELECT id, titulo, conteudo, imagem, data_publicacao FROM noticias ORDER BY data_publicacao DESC;";
                                    $result = $conn->query($sql);
                                    $imageParam = isset($row["image"]) ? $row["image"] : '';

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td class='d-none d-lg-table-cell py-3'><a href='news_img/" . $row["imagem"] . "'><img src='news_img/" . $row["imagem"] . "' alt='" . $row["titulo"] . "_img'</a></td>";
                                            echo "<td class='d-table-cell py-3'>" . $row["titulo"] . "</td>";
                                            echo "<td class='d-table-cell py-3'>" . $row["conteudo"] . "</td>";
                                            echo "<td class='d-table-cell py-3'>" . $row["data_publicacao"] . "</td>";
                                            echo "<td class='d-table-cell text-center py-3'><a href='edit_news.php?id=" . $user_id . "&news_id=" . $row["id"] . "'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                                            echo "<td class='d-table-cell text-center py-3'><a href='includes/delete_news.inc.php?id=" . $user_id . "&news_id=" . $row["id"] . "&image=" . $imageParam . "' onclick=\"return confirm('Tens a certeza que queres apagar esta notícia? Esta ação é irreversível!');\"><i class='fa-solid fa-trash-can'></i></a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>Nenhuma notícia encontrada.</td></tr>";
                                    }

                                    $conn->close();

                                    ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="form-group mt-5 mb-5 d-flex justify-content-around">
                            <a class="btn back-btn" id="users-list-back-btn" href="<?= $BASE_URL ?>/dashboard_admin.php?id=<?= $user_id ?>" target="_self">Voltar</a>
                        </div>

                        <hr>

                        <!-- Formulário de Inserção de Notícias -->
                        <div class="row mt-5">
                            <div class="col-10 col-md-8 col-lg-6 col-xl-5 mx-auto bg-light p-4">

                                <h3 class="text-center">Inserir nova notícia</h3>

                                <form method="post" action="includes/insert_news.inc.php" enctype="multipart/form-data">
                                    <div class="form-group mt-4">
                                        <label for="title">Título:</label>
                                        <input type="text" class="form-control" name="titulo" required>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label for="image">Imagem:</label>
                                        <input type="file" class="form-control-file" name="image" accept="image/*" required>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label for="content">Conteúdo:</label>
                                        <textarea class="form-control" name="conteudo" rows="5" required></textarea>
                                    </div>

                                    <div class="form-group mt-4 text-center">
                                        <input type="submit" name="submit" class="btn" id="insert-project-btn" value="Inserir notícia">
                                    </div>

                                </form>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </main>

    <?php
    // Incluir o footer
    require_once("templates/footer.php");
    ?>

    <!-- Bootstrap JavaScript Bundle -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <!-- Script JS -->
    <script src="js/script.js?v=3"></script>

</body>

</html>