<?php

// Incluir o link da raiz do projeto e iniciar sessão
require_once("geral.php");

// Incluir o modelo de User
require_once("models/User.php");

if (!isset($_SESSION["id"])) {
    header("location: index.php");
    exit();
}

// Ligação à base de dados
require_once("includes/db.inc.php");

// Obter o ID do usuário da sessão
$user_id = $_GET["id"];

// Usar prepared statement para ir buscar os dados do utilizador
$stmt = $conn->prepare("SELECT nome, apelido, dataNascimento, telefone, email, tipo FROM utilizadores WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nome, $apelido, $dataNascimento, $telefone, $email, $tipo);
$stmt->fetch();

// Criar um objeto da classe User com os dados do utilizador
require_once("models/User.php");
$user = new User($user_id, $nome, $apelido, $dataNascimento, $telefone, $email, $tipo);

// Fechar o prepared statement e a ligação com a base de dados
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
                        <a class="nav-link active" aria-current="page" href="<?= $BASE_URL ?>/index.php">Home</a>
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
                    // Se logado, aparece o item Profile e o item Logout na Navbar
                    if (isset($_SESSION["email"])) {
                        if ($_SESSION["tipo"] === "admin") {
                            echo '<li class="nav-item ps-0 ps-lg-3"><a class="nav-link active" href="' . $BASE_URL . '/dashboard_admin.php?id=' . $_SESSION['id'] . '"><i class="fa-solid fa-user"></i> Olá, ' . htmlspecialchars($_SESSION["nome"]) . '</a></li>';
                        } else if ($_SESSION["tipo"] === "cliente") {
                            echo '<li class="nav-item ps-0 ps-lg-3"><a class="nav-link active" href="' . $BASE_URL . '/profile_user.php?id=' . $_SESSION['id'] . '"><i class="fa-solid fa-user"></i> Olá, ' . htmlspecialchars($_SESSION["nome"]) . '</a></li>';
                        }
                        echo '<li class="nav-item ps-0 ps-lg-3"><a class="nav-link" href="' . $BASE_URL . '/includes/logout.inc.php">Logout</a></li>';
                    } else {
                        // Se não estiver logado, aparece o item Login/Registo na Navbar
                        echo '<li class="nav-item ps-0 ps-lg-3"><a class="nav-link" href="' . $BASE_URL . '/login.php"><i class="fa-solid fa-user"></i> Login</a></li>';
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
                    <h2>Editar perfil</h2>
                    <hr>
                </div>

                <div class="row">

                    <div id="profile-box-edit" class="col-8 col-md-6 col-lg-4 col-xl-3 mx-auto">

                        <form id="form" action="<?= $BASE_URL ?>/includes/edit_profile.inc.php" method="POST">

                            <?php
                            if (isset($_GET["error"])) {

                                // Sistema de mensagens
                                if ($_GET["error"]  == "none") {
                                    echo "<div class='alert alert-success text-center' role='alert'>Dados atualizados com sucesso!</div>";
                                } else if ($_GET["error"]  == "stmtfailed") {
                                    echo "<div class='alert alert-danger text-center' role='alert'>Não foi possível atualizar os dados!</div>";
                                } else if ($_GET["error"]  == "emptyinput") {
                                    echo "<div class='alert alert-danger text-center' role='alert'>Por favor, preencha todos os campos!</div>";
                                }
                            }
                            ?>

                            <div class="form-group mt-3 mb-2 d-block align-items-center">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="email" class="form-control no-edit" id="email" name="email" value="<?= $user->getEmail(); ?>" readonly>
                            </div>

                            <div class="form-group mt-3 mb-2 d-block align-items-center">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($user->getFirstname()); ?>">
                            </div>
                            <div class="form-group mb-2 d-block align-items-center">
                                <label for="apelido" class="form-label">Apelido:</label>
                                <input type="text" class="form-control" id="apelido" name="apelido" value="<?= htmlspecialchars($user->getLastName()); ?>">
                            </div>
                            <div class="form-group mb-2 d-block align-items-center">
                                <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
                                <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="<?= date('Y-m-d', strtotime($user->getBirthdayDMY())); ?>">
                            </div>
                            <div class="form-group mb-4 d-block align-items-center">
                                <label for="telefone" class="form-label">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" maxlength="9" value="<?= $user->getPhone(); ?>">
                            </div>
                            <div class="form-group mb-4 d-flex justify-content-around">
                                <input type="hidden" name="id" value="<?= $user_id ?>">
                                <input type="submit" name="submit" class="btn" id="update-btn" value="Alterar">

                                <?php
                                if ($_SESSION['tipo'] === "admin" && $_SESSION['id'] == $user_id) {
                                    $backlink = "$BASE_URL/profile_admin.php?id=" . $_SESSION['id'];
                                } else {
                                    $backlink = "$BASE_URL/profile_user.php?id=" . $user_id;
                                }
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

</html>