<?php
$host    = "localhost"; 
$usuario = "vagn5934_vagner";          // 👈 usuário MySQL criado no cPanel
$senha   = "202018vA?";                // 👈 senha definida no cPanel
$banco   = "vagn5934_vagn5934_blog";   // 👈 nome do banco criado no cPanel

// Criar conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verificar erros
if ($conn->connect_error) {
    error_log("Erro de conexão: " . $conn->connect_error); 
    die("⚠️ Erro ao conectar ao banco de dados. Tente novamente mais tarde.");
}

// Forçar charset UTF-8
if (!$conn->set_charset("utf8mb4")) {
    error_log("Erro ao definir charset: " . $conn->error);
}
?>
