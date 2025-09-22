<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../includes/conexao.php';
include '../includes/cabecalho.php';

// Verificação de login
if (!isset($_SESSION['usuario_id'])) {
    echo "<p style='color:red'>⚠️ Nenhuma sessão encontrada. Voltando para login...</p>";
    header("Refresh: 2; URL=login.php");
    exit;
}

echo "<main class='dashboard'>";
echo "<h2>Bem-vindo, " . htmlspecialchars($_SESSION['usuario_nome']) . "</h2>";
echo "<p><a href='novo_post.php' class='btn-action btn-edit'>➕ Novo Post</a> | <a href='logout.php' class='btn-action btn-delete'>🚪 Sair</a></p>";

// Mensagens de feedback
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'sucesso') {
        echo "<p class='alert alert-sucesso'>✅ Post publicado com sucesso!</p>";
    } elseif ($_GET['msg'] === 'atualizado') {
        echo "<p class='alert alert-sucesso'>✏️ Post atualizado com sucesso!</p>";
    } elseif ($_GET['msg'] === 'deletado') {
        echo "<p class='alert alert-sucesso'>🗑️ Post deletado com sucesso!</p>";
    } elseif ($_GET['msg'] === 'erro') {
        echo "<p class='alert alert-erro'>❌ Ocorreu um erro. Tente novamente.</p>";
    }
}

// Buscar posts
$sql = "SELECT posts.id, posts.titulo, categorias.nome AS categoria 
        FROM posts 
        LEFT JOIN categorias ON posts.categoria_id = categorias.id 
        ORDER BY posts.criado_em DESC";

$res = $conn->query($sql);

// Renderizar tabela
if ($res && $res->num_rows > 0) {
    echo "<table class='tabela-posts'>
            <tr><th>Título</th><th>Categoria</th><th>Ações</th></tr>";
    
    while ($post = $res->fetch_assoc()) {
        $titulo = htmlspecialchars($post['titulo']);
        $categoria = htmlspecialchars($post['categoria'] ?? 'Sem categoria');
        $id = (int)$post['id'];
        
        echo "<tr>
                <td>$titulo</td>
                <td>$categoria</td>
                <td>
                    <a href='editar_post.php?id=$id' class='btn-action btn-edit'>✏️ Editar</a> 
                    <a href='deletar_post.php?id=$id' class='btn-action btn-delete' onclick=\"return confirm('Tem certeza que deseja excluir este post?');\">🗑️ Deletar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nenhum post encontrado.</p>";
}

echo "</main>";

include '../includes/rodape.php';
