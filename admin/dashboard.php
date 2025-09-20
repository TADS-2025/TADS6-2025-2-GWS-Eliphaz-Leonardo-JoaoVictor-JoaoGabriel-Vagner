<?php
include '../includes/cabecalho.php';
session_start();
include '../includes/conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

echo "<h2>Bem-vindo, " . $_SESSION['usuario'] . "</h2>";
echo "<a href='novo_post.php'>➕ Novo Post</a> | <a href='logout.php'>🚪 Sair</a><hr>";

$res = $conn->query("SELECT posts.id, posts.titulo, categorias.nome AS categoria FROM posts LEFT JOIN categorias ON posts.categoria_id = categorias.id ORDER BY posts.criado_em DESC");

echo "<table border='1' cellpadding='5'>
<tr><th>Título</th><th>Categoria</th><th>Ações</th></tr>";
while ($post = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$post['titulo']}</td>
        <td>{$post['categoria']}</td>
        <td>
            <a href='editar_post.php?id={$post['id']}'>✏️ Editar</a> | 
            <a href='deletar_post.php?id={$post['id']}' onclick=\"return confirm('Tem certeza que deseja excluir?');\">🗑️ Deletar</a>
        </td>
    </tr>";
}
echo "</table>";


include '../includes/rodape.php'; 
?>