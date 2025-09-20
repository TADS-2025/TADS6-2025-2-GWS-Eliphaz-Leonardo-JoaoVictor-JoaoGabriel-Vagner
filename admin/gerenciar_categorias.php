<?php
session_start();
include '../includes/conexao.php';
include '../includes/cabecalho.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_categoria'])) {
    $nome_categoria = $conn->real_escape_string($_POST['nome_categoria']);
    if (!empty($nome_categoria)) {
        $sql = "INSERT INTO categorias (nome) VALUES ('$nome_categoria')";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='mensagem-sucesso'>Categoria adicionada com sucesso!</p>";
        } else {
            echo "<p class='mensagem-erro'>Erro ao adicionar categoria: " . $conn->error . "</p>";
        }
    } else {
        echo "<p class='mensagem-erro'>O nome da categoria não pode ser vazio.</p>";
    }
}

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    
    $sql = "DELETE FROM categorias WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: gerenciar_categorias.php");
        exit;
    } else {
        echo "<p class='mensagem-erro'>Erro ao excluir categoria: " . $conn->error . "</p>";
    }
}

// Lógica para listar as categorias existentes
$sqlCategorias = "SELECT id, nome FROM categorias ORDER BY nome ASC";
$resCategorias = $conn->query($sqlCategorias);
?>

<div class="gerenciar-categorias-container">
    <h2>Gerenciar Categorias</h2>
    <div class="form-card">
        <h3>Adicionar Nova Categoria</h3>
        <form action="" method="post">
            <label for="nome_categoria">Nome da Categoria:</label>
            <input type="text" name="nome_categoria" id="nome_categoria" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>

    <div class="tabela-card">
        <h3>Categorias Existentes</h3>
        <?php if ($resCategorias->num_rows > 0): ?>
        <table class="posts-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($cat = $resCategorias->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $cat['id']; ?></td>
                    <td><?php echo htmlspecialchars($cat['nome']); ?></td>
                    <td>
                        <a href="?delete_id=<?php echo $cat['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">🗑️ Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>Nenhuma categoria encontrada.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/rodape.php'; ?>