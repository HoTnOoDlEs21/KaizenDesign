<?php

// Incluir o link da raiz do projeto e iniciar sessão
require_once("geral.php");

if (!isset($_SESSION["id"]) || ($_SESSION["tipo"] == "cliente" && $_GET['id'] != $_SESSION["id"])) {
    header("location: index.php");
    exit();
}

// Ligação à base de dados
require_once("includes/db.inc.php");

// Obter o ID do usuário da sessão
$user_id = $_GET['id'];

// ----- UTILIZADOR -----

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

// ----- REUNIÕES AGENDADAS -----

// Usar prepared statement para ir buscar os dados das reuniões agendadas
$stmt = $conn->prepare("SELECT id, data, hora, observacoes FROM marcacoes WHERE utilizador_id = ? ORDER BY data");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

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
    <main id="main-container" class="container py-5">
        <div class="row">
            <div class="col-12">
                <div id="profile-name" class="mt-2 mb-5">
                    <h2><?= $user->getFullName(); ?></h2>
                    <hr>
                </div>

                <div id="profile-data" class="row">

                    <div id="profile-box" class="col-lg-4 text-left">
                        <h4 class="profile-box-label mb-5">Dados pessoais</h4>
                        <h5 class="profile-box-label"><i class="fa-solid fa-envelope fa-lg"></i>E-mail</h5>
                        <p class="ps-0 ps-lg-5 mb-4"><?= $user->getEmail(); ?></p>
                        <h5 class="profile-box-label"><i class="fa-solid fa-phone fa-lg"></i>Telefone</h5>
                        <p class="ps-0 ps-lg-5 mb-4"><?= $user->getPhone(); ?></p>
                        <h5 class="profile-box-label"><i class="fa-solid fa-cake-candles"></i>Data de nascimento</h5>
                        <p class="ps-0 ps-lg-5 mb-4"><?= $user->getBirthdayDMY(); ?></p>
                        <div class="mt-3 d-flex justify-content-lg-start justify-content-center">
                            <a href="<?= $BASE_URL ?>/edit_profile.php?id=<?= $user_id ?>" target="_self">
                                <button type="button" class="btn mt-3 mb-5">Editar dados</button>
                            </a>

                            <?php
                            // Se for um admin que estiver logado, não aparece o botão de Alterar Código
                            if ($_GET['id'] == $_SESSION['id']) {
                                echo "<a href='$BASE_URL/change_password.php?id=$user_id' target='_self'><button type='button' class='btn ms-5 mt-3 mb-5'>Alterar palavra-passe</button></a>";
                            }
                            ?>

                        </div>
                    </div>

                    <div id="orders-box" class="col-lg-8">
                        <div class="mb-5">
                            <h4 class="profile-box-label mb-5">Agendamentos</h4>
                            <?php
                            if ($result->num_rows === 0) {
                                echo "<p>Não tem reuniões agendadas.</p>";
                            } else if ($result->num_rows > 0) {
                            ?>

                                <?php
                                if (isset($_GET["error"])) {
                                    // Mensagem de erro ao eliminar reunião
                                    if ($_GET["error"]  === "DeletingError") {
                                        echo "<div class='alert alert-danger text-center' role='alert'>Erro ao eliminar reunião!</div>";
                                    }
                                }
                                ?>

                                <!-- Tabela com lista de reuniões agendadas -->
                                <table class="table table-hover table-fixed" id="meetings-table">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col">Dia</th>
                                            <th scope="col">Hora</th>
                                            <th scope="col">Observações</th>
                                            <th scope="col" class="text-center">Editar</th>
                                            <th scope="col" class="text-center">Apagar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($meeting = $result->fetch_assoc()) {
                                            // Se o dia da reunião já passou e não pode ser editada
                                            if ($meeting["data"] < date('Y-m-d')) {
                                                echo "<tr class='table-active'>";
                                                echo "<td>" . date('d-m-Y', strtotime($meeting['data'])) . "</td>";
                                                echo "<td>" . date('H:i', strtotime($meeting['hora'])) . "</td>";
                                                echo "<td>{$meeting['observacoes']}</td>";
                                                echo "<td></td>";
                                                echo "<td class='text-center'><a type='button' href='$BASE_URL/includes/delete_meeting.inc.php?id=$user_id&meeting_id=" . $meeting['id'] . "'><i class='fa-solid fa-trash-can'></i></a></td>";
                                                echo "</tr>";
                                                // Se a reunião ainda vai realizar-se e pode ser editada
                                            } else {
                                                echo "<tr>";
                                                echo "<td>" . date('d-m-Y', strtotime($meeting['data'])) . "</td>";
                                                echo "<td>" . date('H:i', strtotime($meeting['hora'])) . "</td>";
                                                echo "<td>{$meeting['observacoes']}</td>";
                                                echo "<td class='text-center'><a href='$BASE_URL/edit_meeting.php?id=$user_id&meeting_id=" . $meeting['id'] . "'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                                                echo "<td class='text-center'><a type='button' href='$BASE_URL/includes/delete_meeting.inc.php?id=$user_id&meeting_id=" . $meeting['id'] . "' onclick='return confirmDelete();'><i class='fa-solid fa-trash-can'></i></a></td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>

                        <?php
                        if ($_SESSION["tipo"] != "admin"):
                        ?>

                            <div id="schedule-box" class="col-10 col-md-8 col-xl-7 col-xxl-6 mx-auto formulario mt-5">

                                <div class="row text-center">
                                    <h4 class="profile-box-label mb-5">Pedido de reunião</h4>
                                </div>

                                <form action="<?= $BASE_URL ?>/includes/create_meeting.inc.php" method="POST">

                                    <?php
                                    if (isset($_GET["error"])) {

                                        // Sistema de mensagens
                                        if ($_GET["error"]  == "noneMeetingCreated") {
                                            echo "<div class='alert alert-success text-center' role='alert'>Reunião agendada com sucesso!</div>";
                                        } else if ($_GET["error"]  == "meetingError") {
                                            echo "<div class='alert alert-danger text-center' role='alert'>Erro no agendamento!</div>";
                                        } else if ($_GET["error"]  == "emptyinput") {
                                            echo "<div class='alert alert-danger text-center' role='alert'>Por favor, preencha todos os campos!</div>";
                                        } else if ($_GET["error"]  == "datetimePassed") {
                                            echo "<div class='alert alert-danger text-center' role='alert'>A data inserida já passou!</div>";
                                        } else if ($_GET["error"]  == "lessThan72Hours") {
                                            echo "<div class='alert alert-danger text-center' role='alert'>A reunião deve ser marcada pelo menos com 72h de antecedência.</div>";
                                        }
                                    }
                                    ?>

                                    <div class="form-group mb-3 d-block align-items-center">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="date" class="form-label">Dia pretendido:</label>
                                                <input type="date" class="form-control" id="data" name="data" value="<?php if (isset($_GET["data"])) {
                                                                                                                            echo $_GET['data'];
                                                                                                                        } ?>">
                                            </div>
                                            <div class="col-6">
                                                <label for="time" class="form-label">Hora:</label>
                                                <input type="time" class="form-control" id="hora" name="hora" value="<?php if (isset($_GET["hora"])) {
                                                                                                                            echo $_GET['hora'];
                                                                                                                        } ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 d-block align-items-center">
                                        <label for="password" class="form-label">Observações:</label>
                                        <textarea class="form-control" name="observacoes" id="observacoes" rows="5"><?php if (isset($_GET["observacoes"])) {
                                                                                                                        echo $_GET['observacoes'];
                                                                                                                    } ?></textarea>
                                    </div>
                                    <div class="form-group mt-4 mb-4 text-center">
                                        <input type="submit" name="submit" class="btn" id="login-btn" value="Registar pedido">
                                    </div>
                                </form>

                            </div>

                        <?php endif; ?>

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