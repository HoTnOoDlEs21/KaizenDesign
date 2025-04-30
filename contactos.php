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

    <!----CSS do leaflet---->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />

    <!----CSS do Leaflet Routing Machine---->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />

    <!-- CSS do Leaflet Control Geocoder -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <!----Script do Leaflet-->
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    <!---- SCript do Leaflet Routing Machine---->
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>

    <!-- Script do Leaflet Control Geocoder -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
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
                        <a class="nav-link" href="orcamento.php">Pedido de Orçamento</a>
                    </li>
                    <li class="nav-item ps-0 ps-lg-3">
                        <a class="nav-link active" href="#">Contactos</a>
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
            <h1>Contactos</h1>
            <h4 class="text-center mb-5 subtitle">
                Não hesite em nos contactar. Estamos ao seu dispôr, seja por email,
                telefone ou presencialmente.
            </h4>
        </div>

        <!----Mapa---->
        <section id="contact-map">
            <div class="container">
                <div class="row">
                    <div id="map" class="col-12"></div>
                </div>
            </div>
        </section>

        <div class="text-center">
            <h4 class="text-center my-5 subtitle">
                Se preferir, deixe os seus dados. Entraremos em contacto consigo.
            </h4>
        </div>

        <!----Formulario de contacto---->
        <section id="contact-form" class="mt-5 mb-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div id="contact-column" class="col-10 col-sm-10 col-md-4">
                        <div class="row text-center">
                            <p class="contact-label">
                                <i class="fa-solid fa-location-dot fa-lg"></i> Morada
                            </p>
                            <p>R. de Azevedo Coutinho, 39<br />4100-100 Porto</p>

                            <p class="contact-label">
                                <i class="fa-solid fa-phone fa-lg"></i> Telemóvel
                            </p>
                            <p><a href="tel:912345678">+351 912 345 678</a></p>

                            <p class="contact-label">
                                <i class="fa-brands fa-whatsapp fa-lg"></i>Whatsapp
                            </p>
                            <p>+351 911 222 333</p>

                            <p class="contact-label">
                                <i class="fa-solid fa-envelope fa-lg"></i>E-mail
                            </p>
                            <p>
                                <a href="mailto:info@kaizendesign.com">info@kaizendesign.com</a>
                            </p>

                            <p class="contact-label">Redes sociais</p>
                            <p>
                                <a
                                    href="https://www.facebook.com/kaizendesign"
                                    target="_blank">
                                    <i class="fa-brands fa-facebook fa-lg"></i>
                                </a>
                                <a href="https://twitter.com/kaizendesign" target="_blank">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                                <a
                                    href="https://twitter.com/kaizendesign.com"
                                    target="_blank">
                                    <i class="fa-brands fa-instagram fa-lg"></i>
                                </a>
                                <a
                                    href="https://pt.linkedin.com/kaizendesign"
                                    target="_blank">
                                    <i class="fab fa-linkedin fa-lg"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div
                        class="col-10 col-sm-10 col-md-8 col-lg-6 formulario mt-5 mt-md-0">
                        <form id="form">
                            <div id="dados">
                                <div class="form-group mb-3 mt-2 d-flex align-items-center">
                                    <label for="nome" class="form-label">Nome:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="cont-nome"
                                        name="nome"
                                        required />
                                </div>
                                <div class="form-group mb-3 d-flex align-items-center">
                                    <label for="apelido" class="form-label">Apelido:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="cont-apelido"
                                        name="apelido"
                                        required />
                                </div>
                                <div class="form-group mb-3 d-flex align-items-center">
                                    <label for="telemovel" class="form-label">Telemóvel:</label>
                                    <input
                                        type="tel"
                                        class="form-control"
                                        id="cont-telemovel"
                                        name="telemovel"
                                        required />
                                </div>
                                <div class="form-group mb-3 d-flex align-items-center">
                                    <label for="email" class="form-label">Email:</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="cont-email"
                                        name="email"
                                        required />
                                </div>
                                <div class="form-group mb-3 d-flex align-items-center">
                                    <label for="data" class="form-label">Data:</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="cont-data"
                                        name="data"
                                        required />
                                </div>
                                <div class="form-group mb-3 align-items-center">
                                    <label for="motivo" class="form-label mb-2">Motivo do contacto:</label>
                                    <br />
                                    <textarea
                                        class="form-control"
                                        id="cont-motivo"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="submeter_contacto" type="submit" class="btn mt-3">
                                    Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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