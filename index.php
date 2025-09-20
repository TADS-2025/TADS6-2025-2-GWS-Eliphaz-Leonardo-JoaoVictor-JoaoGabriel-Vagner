<?php
include 'includes/conexao.php';
include 'includes/cabecalho.php';

$sql = "SELECT posts.id, posts.titulo, posts.conteudo, posts.imagem, posts.autor, categorias.nome AS categoria, posts.criado_em 
        FROM posts 
        LEFT JOIN categorias ON posts.categoria_id = categorias.id
        ORDER BY posts.criado_em DESC";
$result = $conn->query($sql);

echo "<div class='post-container'>";
if ($result->num_rows > 0) {
    while ($post = $result->fetch_assoc()) {
        echo "<article>";
        echo "<h2><a href='post.php?id=" . $post['id'] . "'>" . htmlspecialchars($post['titulo']) . "</a></h2>";
        echo "<p><em>Por " . htmlspecialchars($post['autor']) . " em " . $post['criado_em'] . " | Categoria: " . htmlspecialchars($post['categoria']) . "</em></p>";
        echo "<img src='assets/img/" . htmlspecialchars($post['imagem']) . "' alt='Imagem do post'><br>";
        echo "<p>" . htmlspecialchars(substr($post['conteudo'], 0, 150)) . "...</p>";
        echo "</article>";
    }
} else {
    echo "<p>Nenhum post encontrado.</p>";
}
echo "</div>";

include 'includes/rodape.php';
?>
