<?php
//Inclui o link da raiz do projeto
include 'geral.php';
if (isset($_GET["error"])) {
}
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
        <div class="row text-center">
            <h2>Registo</h2>
            <h4 class="text-center mb-4 subtitle">Por favor, insira os seus dados para se registar na nossa página.</h4>
        </div>
    </main>

    <!-- Section Signup -->
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-4 formulario">
                <form id="form" action="<?= $BASE_URL ?>/includes/signup.inc.php" method="POST">

                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"]  == "emptyinput") {
                            echo "<div class='alert alert-danger text-center' role='alert'>Por favor, preencha todos os campos!</div>";
                        } else if ($_GET["error"] == "invalidemail") {
                            echo "<div class='alert alert-danger text-center' role='alert'>Por favor, indique um e-mail válido!</div>";
                        } else if ($_GET["error"] == "passwordsdontmatch") {
                            echo "<div class='alert alert-danger text-center' role='alert'>As palavras-passe inseridas não são iguais.</div>";
                        } else if ($_GET["error"] == "stmtfailed") {
                            echo "<div class='alert alert-danger text-center' role='alert'>Algo correu mal, por favor tente novamente!</div>";
                        } else if ($_GET["error"] == "emailtaken") {
                            echo "<div class='alert alert-danger text-center' role='alert'>O e-mail inserido já foi utilizado!</div>";
                        } else if ($_GET["error"] == "invalidphone") {
                            echo "<div class='alert alert-danger text-center' role='alert'>O telefone tem que ter 9 algarismos.</div>";
                        } else if ($_GET["error"] == "none") {
                            echo "<div class='alert alert-success text-center' role='alert'>Registo concluído! <a href='login.php'>Entrar</a></div>";
                        }
                    }
                    ?>

                    <div class="form-group mt-2 mb-4 d-block align-items-center">
                        <p class="text-center" id="signup-info"><?php if (isset($_GET["error"]) && $_GET["error"] === "none") {
                                                                    echo "";
                                                                } else {
                                                                    echo "Todos os campos são de preenchimento obrigatório";
                                                                } ?></p>
                        <hr>
                    </div>
                    <h4>Dados de acesso</h4>
                    <div class="form-group mt-3 mb-2 d-block align-items-center">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($_GET["email"])) {
                                                                                                    echo $_GET['email'];
                                                                                                } ?>">
                    </div>
                    <div class="form-group mb-2 d-block align-items-center">
                        <label for="senha" class="form-label">Palavra-passe:</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>
                    <div class="form-group mb-4 d-block align-items-center">
                        <label for="passwordrepeat" class="form-label">Confirme a palavra-passe:</label>
                        <input type="password" class="form-control" id="passwordrepeat" name="passwordrepeat">
                    </div>
                    <h4>Dados pessoais</h4>
                    <div class="form-group mt-3 mb-2 d-block align-items-center">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php if (isset($_GET["nome"])) {
                                                                                                    echo $_GET['nome'];
                                                                                                } ?>">
                    </div>
                    <div class="form-group mb-2 d-block align-items-center">
                        <label for="apelido" class="form-label">Apelido:</label>
                        <input type="text" class="form-control" id="apelido" name="apelido" value="<?php if (isset($_GET["apelido"])) {
                                                                                                        echo $_GET['apelido'];
                                                                                                    } ?>">
                    </div>
                    <div class="form-group mb-4 d-block align-items-center">
                        <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="<?php if (isset($_GET["dataNascimento"])) {
                                                                                                                        echo $_GET['dataNascimento'];
                                                                                                                    } ?>">
                    </div>
                    <div class="form-group mb-4 d-block align-items-center">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" maxlength="9" value="<?php if (isset($_GET["telefone"])) {
                                                                                                                        echo $_GET['telefone'];
                                                                                                                    } ?>">
                    </div>
                    <div class="form-group mb-4 d-flex justify-content-center">
                        <input type="submit" name="submit" class="btn" id="register-btn" value="Registar">
                    </div>

                    <?php if (isset($_GET["error"]) && $_GET["error"] === "none") {
                        echo "";
                    } else {
                        echo "<hr>";
                    } ?>
                    <div class="text-center">
                        <p><?php if (isset($_GET["error"]) && $_GET["error"] === "none") {
                                echo "";
                            } else {
                                echo "Já possui conta? Faça login <a href='" . $BASE_URL . "/login.php'>aqui</a>";
                            } ?></p>
                    </div>
                </form>
            </div>
        </div>
    </div>


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