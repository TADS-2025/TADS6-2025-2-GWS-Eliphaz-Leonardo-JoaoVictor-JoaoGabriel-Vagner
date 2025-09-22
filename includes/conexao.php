<?php
$host = "localhost";
$usuario = "root";     // Em produção, crie outro usuário (ex.: blog_user)
$senha = "";           // Defina senha em produção!
$banco = "blog_db";

// Criar conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verificar erros
if ($conn->connect_error) {
    error_log("Erro de conexão: " . $conn->connect_error); // Loga no servidor
    die("⚠️ Erro ao conectar ao banco de dados. Tente novamente mais tarde.");
}

// Forçar charset UTF-8
if (!$conn->set_charset("utf8mb4")) {
    error_log("Erro ao definir charset: " . $conn->error);
}
?>
