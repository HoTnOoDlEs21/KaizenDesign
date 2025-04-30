<?php

// Iniciar a sessão
require_once("../geral.php");
// Incluir a ligação à base de dados
require_once "db.inc.php";
// Incluir o ficheiro das funções
require_once "functions.inc.php";

// Verifica se os dados provêm de um submit

if (isset($_POST["submit"])) {

    $data = mysqli_real_escape_string($conn, $_POST["data"]);
    $hora = mysqli_real_escape_string($conn, $_POST["hora"]);
    $observacoes = mysqli_real_escape_string($conn, $_POST["observacoes"]);
    $user_id = $_POST["id"];
    $meeting_id = $_POST["meeting_id"];

    // Verifica se algum campo não foi preenchido
    if (emptyInputUpdateMeeting($data, $hora, $observacoes) !== false) {
        header("location: ../edit_meeting.php?id=" . $user_id . "&meeting_id=" . $meeting_id . "&error=emptyinput&data=$data&hora=$hora&observacoes=$observacoes");
        exit();
    }

    // Verificar se a data e hora são futuras
    $current_datetime = new DateTime();
    $meeting_datetime = new DateTime($data . ' ' . $hora);

    // Calcular a diferença entre a data da reunião e a data atual em horas
    $diff = $meeting_datetime->diff($current_datetime);
    $diffHours = $diff->h + ($diff->days * 24);

    if ($meeting_datetime < $current_datetime) {
        header("location: ../edit_meeting.php?id=" . $user_id . "&meeting_id=" . $meeting_id . "&error=datetimePassed&data=$data&hora=$hora&observacoes=$observacoes");
        exit();
    } elseif ($diffHours < 72) {
        header("location: ../edit_meeting.php?id=" . $user_id . "&meeting_id=" . $meeting_id . "&error=lessThan72Hours&data=$data&hora=$hora&observacoes=$observacoes");
        exit();
    }

    // Se não houver erros, altera a reunião na base de dados
    updateMeeting($conn, $data, $hora, $observacoes, $meeting_id, $user_id);
} else {
    header("location: ../index.php");
    exit();
}
