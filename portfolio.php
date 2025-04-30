<?php
//Liga à base de dados
include 'conexao.php';
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

    <!----ImageBox CSS---->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/tobiasroeder/imagebox@1.3.1/dist/imagebox.min.css" />

    <!----Stylesheet CSS---->
    <link rel="stylesheet" href="css/style.css?v=1.0" />

    <!----jQuery---->
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
                        <a class="nav-link active" href="#">Portfólio</a>
                    </li>
                    <li class="nav-item ps-0 ps-lg-3">
                        <a class="nav-link" href="orcamento.php">Pedido de Orçamento</a>
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
            <h1>Portfólio</h1>
            <h4 class="text-center mb-5 subtitle">
                O nosso empenho, dedicação e constante melhoria dos nossos serviços
                resultam num vasto leque de clientes. <br />
                Explore cada um para mais detalhes
            </h4>
        </div>

        <!----Portfolio Galeria---->

        <section id="portfolio-gallery" class="portfolio-gallery">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <a>
                            <img
                                src="images/booking1.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/booking1.jpg"
                                data-imagebox-caption="O Booking.com é uma plataforma global de reservas online que conecta viajantes com uma ampla gama de opções de hospedagem, desde hotéis e resorts até apartamentos, pousadas e acomodações únicas." />
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/bookamover.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/bookamover.jpg"
                                data-imagebox-caption="O Bookamover.com é uma plataforma online que facilita a reserva de serviços de mudanças, conectando clientes a empresas de mudanças profissionais." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/zendesk.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/zendesk.jpg"
                                data-imagebox-caption="O Zendesk é uma plataforma de software focada em melhorar a experiência do cliente e o suporte ao cliente para empresas." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/mint-homepage-design.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/mint-homepage-design.jpg"
                                data-imagebox-caption="O Mint é uma plataforma gratuita de gerenciamento financeiro pessoal desenvolvida pela Intuit. É amplamente utilizada para ajudar indivíduos e famílias a monitorar, organizar e melhorar suas finanças pessoais." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/website-freshbooks.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/website-freshbooks.jpg"
                                data-imagebox-caption="O FreshBooks é um software de contabilidade baseado na nuvem, projetado para simplificar a gestão financeira de pequenas empresas e freelancers." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/superiorfireplaces.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/superiorfireplaces.jpg"
                                data-imagebox-caption="A Superior Fireplaces é uma marca líder no setor de lareiras, oferecendo uma ampla gama de produtos de alta qualidade para aquecer e embelezar residências." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/Rippaverse-scaled.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/Rippaverse-scaled.jpg"
                                data-imagebox-caption="A Rippaverse é uma editora independente de quadrinhos fundada por Eric D. July, com o objetivo de revitalizar a cultura dos quadrinhos americanos, oferecendo histórias envolventes e personagens cativantes." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/wiz.io-1-Z1N4aFg.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/wiz.io-1-Z1N4aFg.jpg"
                                data-imagebox-caption="A Wiz é uma startup americana especializada em segurança de computação em nuvem." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/portfolio2a.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/portfolio2a.jpg"
                                data-imagebox-caption="A CloudPassage é uma empresa especializada em segurança e conformidade para ambientes de computação em nuvem, oferecendo soluções que abrangem servidores, containers e recursos de Infraestrutura como Serviço (IaaS) em ambientes públicos, privados, híbridos e multi-nuvem." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/portfolio1a.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/portfolio1a.jpg"
                                data-imagebox-caption="O Prezi é uma plataforma inovadora de design de apresentações que se destaca por seu formato não linear, permitindo a criação de apresentações dinâmicas e interativas." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/portfolio3a.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/portfolio3a.jpg"
                                data-imagebox-caption="O Airbnb é uma plataforma online de hospedagem que conecta viajantes a anfitriões que oferecem acomodações únicas em mais de 220 países e regiões." /></a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a><img
                                src="images/website-gleamin.jpg"
                                data-imagebox="gallery"
                                data-imagebox-src="images/website-gleamin.jpg"
                                data-imagebox-caption="A Gleamin é uma marca de cuidados com a pele que se destaca por oferecer soluções naturais e eficazes para tratar hiperpigmentação, manchas escuras e promover uma pele radiante." /></a>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center mt-4">
            <a href="orcamento.php" target="_self">
                <button type="button" class="btn mt-3">
                    Solicite orçamento grátis
                </button>
            </a>
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

    <!----ImageBox JavaScript---->
    <script src="https://cdn.jsdelivr.net/gh/tobiasroeder/imagebox@1.3.1/dist/imagebox.min.js"></script>
</body>

</html>