<?php
include 'includes/conexao.php';
include 'includes/cabecalho.php';

// Validar o ID recebido
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 🚀 Inserir comentário (se enviado)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
    $autor = $conn->real_escape_string($_POST['autor']);
    $comentario = $conn->real_escape_string($_POST['comentario']);

    $sqlInsert = "INSERT INTO comentarios (post_id, autor, comentario) 
                  VALUES ($id, '$autor', '$comentario')";
    $conn->query($sqlInsert);
}

// Buscar post
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
    $conteudo = nl2br(htmlspecialchars($post['conteudo']));
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

    // 🚀 Formulário de comentários
    echo "<section class='comentarios'>";
    echo "<h3>Deixe seu comentário</h3>";
    echo "<form method='post' class='form-comentario'>";
    echo "  <input type='text' name='autor' placeholder='Seu nome' required>";
    echo "  <textarea name='comentario' placeholder='Escreva seu comentário' required></textarea>";
    echo "  <button type='submit'>Enviar</button>";
    echo "</form>";

    // 🚀 Listar comentários
    $resComentarios = $conn->query("SELECT * FROM comentarios WHERE post_id=$id ORDER BY criado_em DESC");
    echo "<h3>Comentários</h3>";
    if ($resComentarios && $resComentarios->num_rows > 0) {
        while ($c = $resComentarios->fetch_assoc()) {
            echo "<div class='comentario'>";
            echo "<p><strong>" . htmlspecialchars($c['autor']) . "</strong> em " . date("d/m/Y H:i", strtotime($c['criado_em'])) . "</p>";
            echo "<p>" . nl2br(htmlspecialchars($c['comentario'])) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Seja o primeiro a comentar!</p>";
    }
    echo "</section>";

} else {
    echo "<p class='alert alert-erro'>❌ Post não encontrado.</p>";
}

echo "</main>";

include 'includes/rodape.php';
?>
