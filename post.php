<?php
include 'includes/conexao.php';
include 'includes/cabecalho.php';

// Validar o ID recebido
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT posts.id, posts.titulo, posts.conteudo, posts.imagem, posts.autor, categorias.nome AS categoria, posts.criado_em 
        FROM posts 
        LEFT JOIN categorias ON posts.categoria_id = categorias.id
        WHERE posts.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

echo "<main class='blog-container'>";

if ($post) {
    $titulo = htmlspecialchars($post['titulo']);
    $autor = htmlspecialchars($post['autor']);
    $categoria = htmlspecialchars($post['categoria'] ?? 'Sem categoria');
    $conteudo = nl2br(htmlspecialchars($post['conteudo'])); // mantém quebras de linha
    $imagem = htmlspecialchars($post['imagem']);
    
    // Data em estilo blog
    setlocale(LC_TIME, 'pt_BR.utf8');
    $data = strftime("%d de %B, %Y", strtotime($post['criado_em']));

    echo "<article class='post-detalhe'>";
    if (!empty($imagem)) {
        echo "<div class='post-capa'><img src='assets/img/$imagem' alt='Imagem do post'></div>";
    }
    echo "<div class='post-conteudo'>";
    echo "  <span class='badge'>$categoria</span>";
    echo "  <h1>$titulo</h1>";
    echo "  <p class='meta'>Por $autor em $data</p>";
    echo "  <div class='post-texto'>$conteudo</div>";
    echo "  <p><a href='index.php' class='btn-read'>← Voltar ao Blog</a></p>";
    echo "</div>";
    echo "</article>";
} else {
    echo "<p class='alert alert-erro'>❌ Post não encontrado.</p>";
}

echo "</main>";

include 'includes/rodape.php';
?>
