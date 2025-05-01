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

// Fechar o prepared statement e a ligação com a base de dados
$stmt->close();

// --- PROJECT ---

// Obter o ID do projeto
$project_id = $_GET["project_id"];

// Usar prepared statement para ir buscar os dados do projeto
$stmt = $conn->prepare("SELECT titulo, imagem, descricao, tecnologia, tempo_gasto FROM projetos WHERE id = ?;");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$stmt->bind_result($titulo, $imagem, $descricao, $tecnologia, $tempo_gasto);
$stmt->fetch();

// Criar um objeto da classe Project com os dados do projeto
require_once("models/Project.php");
$project = new Project($project_id, $titulo, $imagem, $descricao, $tecnologia, $tempo_gasto);

// Fechar o prepared statement
$stmt->close();

$conn->close();

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
                <div id="profile-name" class="mt-2 mb-5 text-center">
                    <h2>Editar projeto</h2>
                    <hr>
                </div>

                <div class="row">

                    <div id="project-box-edit" class="col-10 col-md-8 col-lg-6 col-xl-5 mx-auto bg-light p-4">

                        <form method="POST" action="includes/edit_project.inc.php" enctype="multipart/form-data">

                            <?php

                            if (isset($_GET["error"])) {

                                // Sistema de mensagens
                                if ($_GET["error"]  == "none") {
                                    echo "<div class='alert alert-success text-center mb-4' role='alert'>Projeto alterado com sucesso!</div>";
                                } else if ($_GET["error"]  == "stmtfailed") {
                                    echo "<div class='alert alert-danger text-center mb-4' role='alert'>Não foi possível alterar o projeto!</div>";
                                } else if ($_GET["error"]  == "invalidformat") {
                                    echo "<div class='alert alert-danger text-center mb-4' role='alert'>Formato de arquivo não permitido. Apenas arquivos JPG, JPEG e PNG são aceites.</div>";
                                }
                            }

                            ?>

                            <div class="form-group mt-3 mb-2 d-block align-items-center">
                                <input type="hidden" class="form-control" id="project_id" name="project_id" value="<?= $project->getId(); ?>">
                            </div>

                            <div class="form-group mt-3 text-center">
                                <img id="project-img" src="projects_img/<?= $project->getImage(); ?>" alt="Project-img">
                            </div>

                            <div class="form-group mt-4">
                                <label for="title">Título:</label>
                                <input type="text" class="form-control" name="title" required value="<?= $project->getTitle(); ?>">
                                <input type="hidden" class="form-control" id="actualImg" name="actualImg" value="<?= $project->getImage(); ?>">
                            </div>

                            <div class="form-group mt-4">
                                <label for="image">Nova imagem (opcional):</label>
                                <input type="file" class="form-control-file" name="image" accept="image/*">
                            </div>

                            <div class="form-group mt-4">
                                <label for="description">Descrição:</label>
                                <textarea class="form-control" name="description" rows="4" required><?= $project->getDescription(); ?></textarea>
                            </div>

                            <div class="form-group mt-4">
                                <label for="technology">Tecnologia:</label>
                                <input type="text" class="form-control" name="technology" required value="<?= $project->getTechnology(); ?>">
                            </div>

                            <div class="form-group mt-4 mb-4">
                                <label for="timeSpent">Tempo de conclusão (em meses):</label>
                                <input type="text" class="form-control" name="timeSpent" required value="<?= $project->getTimeSpent(); ?>">
                            </div>

                            <div class="form-group mt-4 mb-4 d-flex justify-content-around">
                                <input type="submit" name="submit" class="btn" id="update-btn" value="Alterar projeto">
                                <input type="hidden" name="id" value="<?= $user_id; ?>">

                                <?php
                                $backlink = "$BASE_URL/projects.php?id=" . $_SESSION['id'];
                                ?>

                                <a class="btn back-btn" id="back-btn" href="<?php echo $backlink; ?>" target="_self">Voltar</a>
                            </div>

                        </form>

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