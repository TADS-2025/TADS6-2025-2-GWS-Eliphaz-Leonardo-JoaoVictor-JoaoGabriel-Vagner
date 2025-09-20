<?php
include '../includes/cabecalho.php';
session_start();
include '../includes/conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
echo "<div class='dashboard-header'>";
echo "<div class='dashboard-actions'>";
echo "<a href='novo_post.php' class='button-link'>➕ Novo Post</a>";
echo "<a href='gerenciar_categorias.php' class='button-link'>Gerenciar Categorias</a>";
echo "<a href='logout.php' class='button-link secondary'>🚪 Sair</a>";
echo "</div>";
echo "</div>";
echo "<hr>";

$res = $conn->query("SELECT posts.id, posts.titulo, categorias.nome AS categoria FROM posts LEFT JOIN categorias ON posts.categoria_id = categorias.id ORDER BY posts.criado_em DESC");

echo "<table border='1' cellpadding='5'>
<tr><th>Título</th><th>Categoria</th><th>Ações</th></tr>";
while ($post = $res->fetch_assoc()) {
    echo "<tr>
        <td>{$post['titulo']}</td>
        <td>{$post['categoria']}</td>
        <td>
            <a href='editar_post.php?id={$post['id']}'> Editar</a> | 
            <a href='deletar_post.php?id={$post['id']}' onclick=\"return confirm('Tem certeza que deseja excluir?');\"> Deletar</a>
        </td>
    </tr>";
}
echo "</table>";


include '../includes/rodape.php'; 
?>