<?php
//Dados da ligação
$servidor = "localhost";
$utilizador = "root";
$senha = "";
$base_dados = "CPkaizen_php";

//Criar a ligação
$conn = new mysqli($servidor, $utilizador, $senha, $base_dados);

//Verificar ligação
if ($conn->connect_error) {
    die("Erro de ligação: " . $conn->connect_error);
}
