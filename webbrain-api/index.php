<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json");
    $nome = $_GET["nome"] ?? "Guilherme";
    $sobrenome = $_GET["sobrenome"] ?? "de Souza dos Santos";

    echo json_encode($nome . " " . $sobrenome);
?>