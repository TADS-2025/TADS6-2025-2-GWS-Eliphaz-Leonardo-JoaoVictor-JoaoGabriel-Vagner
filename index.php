<?php
include 'includes/conexao.php';
include 'includes/cabecalho.php';

$sql = "SELECT posts.id, posts.titulo, posts.conteudo, posts.imagem, posts.autor, categorias.nome AS categoria, posts.criado_em 
        FROM posts 
        LEFT JOIN categorias ON posts.categoria_id = categorias.id
        ORDER BY posts.criado_em DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($post = $result->fetch_assoc()) {
        echo "<article>";
        echo "<h2><a href='post.php?id=" . $post['id'] . "'>" . $post['titulo'] . "</a></h2>";
        echo "<p><em>Por " . $post['autor'] . " em " . $post['criado_em'] . " | Categoria: " . $post['categoria'] . "</em></p>";
        echo "<img src='assets/img/" . $post['imagem'] . "' alt='Imagem do post' style='max-width:200px;'><br>";
        echo "<p>" . substr($post['conteudo'], 0, 150) . "...</p>";
        echo "</article><hr>";
    }
} else {
    echo "<p>Nenhum post encontrado.</p>";
}

include 'includes/rodape.php';
?>
