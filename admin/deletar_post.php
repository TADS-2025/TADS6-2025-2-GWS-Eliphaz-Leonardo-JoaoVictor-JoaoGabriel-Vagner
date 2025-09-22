<?php
session_start();
include '../includes/conexao.php';

// Verificação de login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Buscar post
$sql = "SELECT imagem FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if ($post) {
    // Deletar do banco
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Se tinha imagem, apagar do servidor
        if (!empty($post['imagem']) && file_exists("../assets/img/" . $post['imagem'])) {
            unlink("../assets/img/" . $post['imagem']);
        }

        // 🔥 Redireciona de volta para o dashboard com mensagem
        header("Location: dashboard.php?msg=deletado");
        exit;
    } else {
        // Só mostra erro se falhar
        include '../includes/cabecalho.php';
        echo "<main class='dashboard'><p class='alert alert-erro'>❌ Erro ao deletar o post: " . $conn->error . "</p></main>";
        include '../includes/rodape.php';
        exit;
    }
} else {
    include '../includes/cabecalho.php';
    echo "<main class='dashboard'><p class='alert alert-erro'>⚠️ Post não encontrado.</p></main>";
    include '../includes/rodape.php';
    exit;
}
