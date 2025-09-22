<?php
include 'includes/conexao.php';
include 'includes/cabecalho.php';

$sql = "SELECT posts.id, posts.titulo, posts.conteudo, posts.imagem, posts.autor, categorias.nome AS categoria, posts.criado_em 
        FROM posts 
        LEFT JOIN categorias ON posts.categoria_id = categorias.id
        ORDER BY posts.criado_em DESC";

$result = $conn->query($sql);

echo "<main class='blog-container'>";

if ($result && $result->num_rows > 0) {
    echo "<div class='posts-grid'>";
    while ($post = $result->fetch_assoc()) {
        $titulo = htmlspecialchars($post['titulo']);
        $autor = htmlspecialchars($post['autor']);
        $categoria = htmlspecialchars($post['categoria'] ?? 'Sem categoria');
        $conteudo = htmlspecialchars($post['conteudo']);
        $imagem = htmlspecialchars($post['imagem']);
        
        // Data em estilo blog
        setlocale(LC_TIME, 'pt_BR.utf8');
        $data = strftime("%d de %B, %Y", strtotime($post['criado_em']));
        
        $resumo = mb_strimwidth($conteudo, 0, 150, "...");
        
        echo "<article class='card'>";
        if (!empty($imagem)) {
            echo "  <div class='card-img'><img src='assets/img/$imagem' alt='Imagem do post'></div>";
        }
        echo "  <div class='card-body'>";
        echo "    <span class='badge'>$categoria</span>";
        echo "    <h2><a href='post.php?id={$post['id']}'>$titulo</a></h2>";
        echo "    <p class='meta'>Por $autor em $data</p>";
        echo "    <p class='excerpt'>$resumo</p>";
        echo "    <a href='post.php?id={$post['id']}' class='btn-read'>Leia mais →</a>";
        echo "  </div>";
        echo "</article>";
    }
    echo "</div>";
} else {
    echo "<p>Nenhum post encontrado.</p>";
}

echo "</main>";

include 'includes/rodape.php';
?>
