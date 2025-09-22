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
    while ($post = $result->fetch_assoc()) {
        $titulo = htmlspecialchars($post['titulo']);
        $autor = htmlspecialchars($post['autor']);
        $categoria = htmlspecialchars($post['categoria'] ?? 'Sem categoria');
        $conteudo = htmlspecialchars($post['conteudo']);
        $imagem = htmlspecialchars($post['imagem']);

        // Data em estilo blog
        setlocale(LC_TIME, 'pt_BR.utf8');
        $data = strftime("%d de %B, %Y", strtotime($post['criado_em']));

        $resumo = mb_strimwidth($conteudo, 0, 200, "...");

        echo "<article class='post-linha'>";

        if (!empty($imagem)) {
            echo "  <div class='post-img'>
                        <img src='assets/img/$imagem' alt='Imagem do post'>
                    </div>";
        }

        echo "  <div class='post-body'>
                    <span class='badge'>$categoria</span>
                    <h2><a href='post.php?id={$post['id']}'>$titulo</a></h2>
                    <p class='meta'>Por $autor em $data</p>
                    <p class='excerpt'>$resumo</p>
                    <a href='post.php?id={$post['id']}' class='btn-read'>Leia mais →</a>
                </div>";

        echo "</article>";
    }
} else {
    echo "<p>Nenhum post encontrado.</p>";
}

echo "</main>";

include 'includes/rodape.php';
?>
