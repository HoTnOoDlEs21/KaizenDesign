<?php
//Inclui o link da raiz do projeto
include 'geral.php';
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

    <!----Font Awesome---->
    <script
        src="https://kit.fontawesome.com/265e8c9848.js"
        crossorigin="anonymous"></script>

    <!----Bootstrap’s CSS---->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous" />

    <!----Stylesheet CSS---->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <?php
    // Inclui o header
    require_once("templates/header.php");
    ?>

    <!----Navbar---->
    <nav class="navbar navbar-custom sticky-top navbar-light navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img
                    src="images/KaizenDesignName.png"
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
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item ps-0 ps-lg-3">
                        <a class="nav-link" href="portfolio.php">Portfólio</a>
                    </li>
                    <li class="nav-item ps-0 ps-lg-3">
                        <a class="nav-link active" href="#">Pedido de Orçamento</a>
                    </li>
                    <li class="nav-item ps-0 ps-lg-3">
                        <a class="nav-link" href="contactos.php">Contactos</a>
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

    <!---- Main ---->
    <main class="container py-5">
        <div class="text-center">
            <h1>Pedido de Orçamento</h1>
            <h4 class="text-center mb-5 subtitle">
                Faça aqui a sua simulação com base no que deseja para o seu projeto e
                não hesite em nos contactar.<br />
            </h4>
        </div>

        <!----Section Orçamento---->
        <section id="contact" class="pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-10 col-sm-10 col-md-8 col-lg-6 formulario">
                        <form
                            id="form"
                            action=""
                            method=""
                            onsubmit="return validar_pedido(this)">
                            <div id="dados">
                                <h4>Dados Pessoais</h4>
                                <div class="form-group mb-2 d-flex align-items-center">
                                    <label for="nome" class="form-label">Nome:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        maxlength="30"
                                        size="20"
                                        id="nome"
                                        name="nome"
                                        value=""
                                        placeholder="O seu primeiro nome"
                                        required />*
                                </div>
                                <div class="form-group mb-2 d-flex align-items-center">
                                    <label for="apelido" class="form-label">Apelido:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        maxlength="30"
                                        size="20"
                                        id="apelido"
                                        name="apelido"
                                        value=""
                                        placeholder="O seu apelido"
                                        required />*
                                </div>
                                <div class="form-group mb-2 d-flex align-items-center">
                                    <label for="telemovel" class="form-label">Telemóvel:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="telemovel"
                                        id="telemovel"
                                        maxlength="9"
                                        size="10"
                                        value=""
                                        placeholder="O seu telemóvel"
                                        required />*
                                </div>
                            </div>

                            <div id="pedido" class="mb-4">
                                <h4 class="pt-3">Pedido de Orçamento</h4>
                                <div class="form-group mb-2 d-flex align-items-center">
                                    <label for="tipo" class="form-label">Tipo de página web:</label>
                                    <select name="tipo" class="form-select" id="tipo" required>
                                        <option value="" selected>-- Escolha uma opção --</option>
                                        <option value="simples">Website simples</option>
                                        <option value="institucional">
                                            Website institucional
                                        </option>
                                        <option value="loja">Loja online</option>
                                        <option value="blog">Blog</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 d-flex align-items-center">
                                    <label for="prazo" class="form-label">Prazo em meses:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="prazo"
                                        name="prazo"
                                        required />
                                </div>
                                <h5 class="pt-2">Assinale os separadores desejados</h5>
                                <div class="form-group mb-3 align-items-center">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            value=""
                                            id="quemsomos" />
                                        <label for="quemsomos" class="form-check-label">Quem somos</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            value=""
                                            id="ondeestamos" />
                                        <label for="ondeestamos" class="form-check-label">Onde estamos</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            value=""
                                            id="galeria" />
                                        <label for="galeria" class="form-check-label">Galeria de fotografias</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            value=""
                                            id="ecommerce" />
                                        <label for="ecommerce" class="form-check-label">eCommerce</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            value=""
                                            id="gestaointerna" />
                                        <label for="gestaointerna" class="form-check-label">Gestão interna</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            value=""
                                            id="noticias" />
                                        <label for="noticias" class="form-check-label">Notícias</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            value=""
                                            id="redes" />
                                        <label for="redes" class="form-check-label">Redes sociais</label>
                                    </div>
                                </div>
                            </div>

                            <button id="submeter_orcamento" type="submit" class="btn mb-3">
                                Submeter pedido
                            </button>

                            <hr />

                            <div id="estimado">
                                <h4 class="pt-3 mb-1">Orçamento estimado</h4>
                                <p id="info">
                                    (Valor meramente indicativo, pode sofrer alterações.)
                                </p>
                                <input
                                    type="text"
                                    class="form-control text-center"
                                    name="resultado"
                                    id="resultado" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center">
            <h4 class="text-center mt-4 subtitle">
                Caso tenha dúvidas, não hesite em nos contactar.
            </h4>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="contactos.php" target="_self">
                            <button type="button" class="btn mt-3">Contactos</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    // Incluir o footer
    require_once("templates/footer.php");
    ?>

    <!----Bootstrap JavaScript Bundle---->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <!----jQuery---->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!----Script JS---->
    <script src="js/script.js?v=3"></script>
</body>

</html>