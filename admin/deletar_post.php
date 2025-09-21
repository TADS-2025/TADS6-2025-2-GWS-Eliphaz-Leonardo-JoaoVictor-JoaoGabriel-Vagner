<?php
session_start();
include '../includes/conexao.php';

// Verificação de login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Primeiro, buscar o post para saber se existe e pegar a imagem
$sql = "SELECT imagem FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if ($post) {
    // Apagar do banco
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Se tinha imagem, apagar do servidor
        if (!empty($post['imagem']) && file_exists("../assets/img/" . $post['imagem'])) {
            unlink("../assets/img/" . $post['imagem']);
        }

        header("Location: dashboard.php?msg=deletado");
        exit;
    } else {
        echo "<p style='color:red;'>Erro ao deletar o post: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color:red;'>Post não encontrado.</p>";
}
?>
