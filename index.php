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

    <!--<script>
        $(document).ready(function() {
            //Mensagem de boas-vindas
            setTimeout(function() {
                alert("Seja bem-vindo ao website da KaizenDesign!");
            }, 5000);
        });
    </script>-->
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
        <div class="row">
            <div class="col-lg-9">
                <!-- Intro Section -->
                <section id="intro" class="pb-5">
                    <div class="row text-center mb-4">
                        <h1>Você imagina o seu projecto, nós tornamos realidade!</h1>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <img
                                id="intro-pic"
                                src="images/lee-campbell-DtDlVpy-vvQ-unsplash.jpg"
                                alt=""
                                width="100%" />
                        </div>
                        <div id="intro-text" class="col-12 col-md-6 mt-3 mt-md-0">
                            <p>
                                Somos uma empresa de desenvolvimento de websites já com um
                                portfólio vasto, criamos o seu projecto de acordo com as suas
                                necessidades e de forma personalizada. <br />
                                <br />
                                Conheça o nosso trabalho e contacte-nos, para o ajudarmos a
                                criar o projeto que imaginou. <br />
                                <br />
                                Irá contratar uma equipa multidisciplinar e experiente que
                                potenciará ao máximo a imagem e visibilidade da sua empresa na
                                web, aumentando assim o volume de negócios. Não hesite em nos
                                contactar.
                            </p>
                        </div>
                    </div>

                    <div class="row text-center mt-3">
                        <a href="orcamento.php" target="_self">
                            <button type="button" class="btn mt-3">
                                Solicite orçamento grátis
                            </button>
                        </a>
                    </div>
                </section>

                <!----Serviços---->
                <section id="services" class="bg-light pt-5 pb-3">
                    <div class="container px-4">
                        <h2 class="text-center">Os nossos pontos fortes</h2>
                        <h4 class="text-center mb-5 subtitle">
                            Um compromisso de melhoria continua em busca da eficiência
                            máxima
                        </h4>
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-desktop fa-3x mb-3"></i>
                                        <h4 class="card-title mb-3">Design moderno</h4>
                                        <p class="card-text">
                                            Procuramos garantir os designs mais incríveis e
                                            inovadores para o seu site, proporcionando uma
                                            experiência de utilizador inesquecível.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-mobile-alt fa-3x mb-3"></i>
                                        <h4 class="card-title mb-3">Website responsivo</h4>
                                        <p class="card-text">
                                            Tornamos o seu website responsivo para que se adapte a
                                            qualquer dispositivo e tamanho de tela.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-search fa-3x mb-3"></i>
                                        <h4 class="card-title mb-3">Motores de pesquisa</h4>
                                        <p class="card-text">
                                            Pode contar com o nosso empenho para aumentar a
                                            visibilidade e o tráfego do seu site, melhorando o
                                            posicionamento nos principais motores de pesquisa.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-sync fa-3x mb-3"></i>
                                        <h4 class="card-title mb-3">Gestão contínua</h4>
                                        <p class="card-text">
                                            Assumimmos o compromisso de prestar apoio para toda a
                                            manutenção do website, gestão de utilizadores, e
                                            actualizações constantes.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!----News Feed---->
            <aside id="aside" class="container col-lg-3">
                <div class="row">
                    <h4>Notícias</h4>
                    <div class="list-group">
                        <a
                            id="news_link1"
                            href="#"
                            class="list-group-item"
                            target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <img
                                    id="news_img1"
                                    src="https://via.placeholder.com/100x80"
                                    alt="Notícia 1"
                                    class="mr-3" />
                                <h5 id="news_title1" class="mb-1">Título da notícia 1</h5>
                            </div>
                        </a>
                        <a
                            id="news_link2"
                            href="#"
                            class="list-group-item"
                            target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <img
                                    id="news_img2"
                                    src="https://via.placeholder.com/100x80"
                                    alt="Notícia 2"
                                    class="mr-3" />
                                <h5 id="news_title2" class="mb-1">Título da notícia 2</h5>
                            </div>
                        </a>
                        <a
                            id="news_link3"
                            href="#"
                            class="list-group-item"
                            target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <img
                                    id="news_img3"
                                    src="https://via.placeholder.com/100x80"
                                    alt="Notícia 3"
                                    class="mr-3" />
                                <h5 id="news_title3" class="mb-1">Título da notícia 3</h5>
                            </div>
                        </a>
                        <a
                            id="news_link4"
                            href="#"
                            class="list-group-item"
                            target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <img
                                    id="news_img4"
                                    src="https://via.placeholder.com/100x80"
                                    alt="Notícia 4"
                                    class="mr-3" />
                                <h5 id="news_title4" class="mb-1">Título da notícia 4</h5>
                            </div>
                        </a>
                        <a
                            id="news_link5"
                            href="#"
                            class="list-group-item"
                            target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <img
                                    id="news_img5"
                                    src="https://via.placeholder.com/100x80"
                                    alt="Notícia 5"
                                    class="mr-3" />
                                <h5 id="news_title5" class="mb-1">Título da notícia 5</h5>
                            </div>
                        </a>
                        <a
                            id="news_link6"
                            href="#"
                            class="list-group-item"
                            target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <img
                                    id="news_img6"
                                    src="https://via.placeholder.com/100x80"
                                    alt="Notícia 6"
                                    class="mr-3" />
                                <h5 id="news_title6" class="mb-1">Título da notícia 6</h5>
                            </div>
                        </a>
                        <a
                            id="news_link7"
                            href="#"
                            class="list-group-item"
                            target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <img
                                    id="news_img7"
                                    src="https://via.placeholder.com/100x80"
                                    alt="Notícia 7"
                                    class="mr-3" />
                                <h5 id="news_title7" class="mb-1">Título da notícia 7</h5>
                            </div>
                        </a>
                        <a
                            id="news_link8"
                            href="#"
                            class="list-group-item"
                            target="_blank">
                            <div class="d-flex w-100 justify-content-between">
                                <img
                                    id="news_img8"
                                    src="https://via.placeholder.com/100x80"
                                    alt="Notícia 8"
                                    class="mr-3" />
                                <h5 id="news_title8" class="mb-1">Título da notícia 8</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <!-- Noticias Empresa -->
    <section id="company-news" class="py-5">
        <div class="container">
            <h2 class="text-center">Últimas notícias Kaizen Design</h2>
            <h4 class="text-center mb-5 subtitle">Clique nas notícias e fique a par das novidades da nossa empresa e da área de desenvolvimento web</h4>

            <!-- Ultimas 5 noticias -->
            <div class="row d-flex justify-content-between mb-5">

                <?php

                // Obtem os dados do SQL para as 5 noticias
                $sql = "SELECT id, titulo, imagem, conteudo, data_publicacao FROM noticias ORDER BY data_publicacao DESC LIMIT 5";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        // Criação de cada miniatura de notícia
                        echo "<div class='col-md-2 news-card' data-news-id='" . $row["id"] . "'>";
                        echo "<img class='company-news-img' src='news_img/" . $row["imagem"] . "' width='100%' alt='" . $row["imagem"] . "'>";
                        echo "<div class='company-news-caption'><p>" . $row["titulo"] . "</p></div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div><p>Nenhuma notícia encontrada.</p></div>";
                }

                $conn->close();

                ?>

            </div>

            <div id="newsDetails" class="row">
                <!-- A informação da notícia será carregada aqui através de AJAX -->
            </div>

        </div>

    </section>

    <!----About us---->
    <section id="about-us" class="py-5 bg-gray">
        <div class="container">
            <h2 class="text-center">Quem Somos</h2>
            <h4 class="text-center mb-5 subtitle">A nossa equipa</h4>
            <div class="row">
                <div class="col-md-6">
                    <p>
                        Somo uma empresa especializada na criação de websites
                        personalizados para cada cliente. Primamos por ter uma equipa de
                        designers e desenvolvedores que trabalha em estreita colaboração
                        com os nossos clientes para garantir que cada website atende às
                        suas necessidades específicas.
                    </p>
                    <p>
                        Estamos há 12 anos no mercado, em constante envolução, temos todos
                        os recursos necessários para entregar as melhores soluções para o
                        seu negócio. Com uma equipa interna de designers, consultores de
                        gestão, programadores e especialistas em Marketing, bem como
                        ferramentas próprias de software e hosting, fazemos jus ao nome da
                        nossa empresa, estando em melhoria continua por forma a mantermos
                        sempre os melhores resultados.
                    </p>
                    <p>
                        Orgulhamo-nos de oferecer serviços de alta qualidade com preços
                        competitivos e à medida das suas necessidades. Se está à procura
                        de um site profissional e personalizado, não hesite em nos
                        contactar para obter orçamento grátis.
                    </p>
                </div>
                <div class="col-md-6">
                    <img
                        src="images/sigmund-Im_cQ6hQo10-unsplash.jpg"
                        alt="about_us"
                        width="100%" />
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center mt-3">
                        <a href="contactos.php" target="_self">
                            <button type="button" class="btn mt-4">Contacte-nos</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!----Portefolio---->
    <section id="gallery" class="py-5">
        <div class="container">
            <h2 class="text-center">Portfólio</h2>
            <h4 class="text-center mb-5 subtitle">Alguns exemplos</h4>
            <div class="row">
                <div class="col-md-4">
                    <img src="images/portfolio1.jpg" alt="Prezi" />
                    <div class="caption">
                        <h4>Prezi</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="images/portfolio2.jpg" alt="CloudPassage" />
                    <div class="caption">
                        <h4>CloudPassage</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="images/portfolio3.jpg" alt="AirBnB" />
                    <div class="caption">
                        <h4>AirBnB</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="portfolio.php" target="_self">
                        <button type="button" class="btn mt-4">Ver Portfólio</button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Inclui o footer
    require_once("templates/footer.php");
    ?>

    <!-- Bootstrap JavaScript Bundle -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <!-- Script JS -->
    <script src="js/script.js?v=4"></script>
</body>

</html>