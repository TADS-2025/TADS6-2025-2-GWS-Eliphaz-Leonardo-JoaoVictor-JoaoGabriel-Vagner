<?php
include 'includes/conexao.php';
include 'includes/cabecalho.php';

$id = intval($_GET['id']);

$sql = "SELECT * FROM posts WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
    echo "<article>";
    echo "<h2>" . $post['titulo'] . "</h2>";
    echo "<p><em>Por " . $post['autor'] . " em " . $post['criado_em'] . "</em></p>";
    echo "<img src='assets/img/" . $post['imagem'] . "' alt='Imagem do post' style='max-width:300px;'><br>";
    echo "<p>" . $post['conteudo'] . "</p>";
    echo "</article><hr>";
} else {
    echo "<p>Post não encontrado.</p>";
}

echo "<h3>Comentários</h3>";

$sqlComentarios = "SELECT * FROM comentarios WHERE post_id=$id ORDER BY criado_em DESC";
$resComentarios = $conn->query($sqlComentarios);

if ($resComentarios->num_rows > 0) {
    while ($comentario = $resComentarios->fetch_assoc()) {
        echo "<div class='comment-card'>";
        echo "<p><strong>" . htmlspecialchars($comentario['autor']) . "</strong>: " . htmlspecialchars($comentario['conteudo']) . "</p>";
        echo "<p class='comment-date'><em>" . $comentario['criado_em'] . "</em></p>";
        echo "</div>";
    }
} else {
    echo "<p>Sem comentários ainda.</p>";
}
?>

<h4>Adicionar Comentário</h4>
<div class="form-container">
    <form method="post">
        <label for="autor">Nome:</label>
        <input type="text" name="autor" id="autor" required>
        <label for="conteudo">Comentário:</label>
        <textarea name="conteudo" id="conteudo" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $autor = $conn->real_escape_string($_POST['autor']);
    $conteudo = $conn->real_escape_string($_POST['conteudo']);
    $sqlInsert = "INSERT INTO comentarios (post_id, autor, conteudo) VALUES ($id, '$autor', '$conteudo')";
    $conn->query($sqlInsert);
    header("Location: post.php?id=$id");
}

include 'includes/rodape.php';
?>
