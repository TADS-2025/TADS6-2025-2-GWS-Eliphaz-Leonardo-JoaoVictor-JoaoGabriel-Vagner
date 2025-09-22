<?php
session_start();
include '../includes/conexao.php';

// Verificação de login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Buscar post
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if (!$post) {
    include '../includes/cabecalho.php';
    echo "<p style='color:red;'>Post não encontrado.</p>";
    include '../includes/rodape.php';
    exit;
}

// Buscar categorias
$res_categorias = $conn->query("SELECT * FROM categorias ORDER BY nome ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $conteudo = trim($_POST['conteudo']);
    $autor = $_SESSION['usuario_nome']; 
    $categoria_id = intval($_POST['categoria']);
    $imagem = $post['imagem']; // mantém a atual por padrão

    // Upload da nova imagem (se enviada)
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

        if (in_array($ext, $extensoesPermitidas)) {
            $novoNome = uniqid("post_", true) . "." . $ext;
            $destino = "../assets/img/" . $novoNome;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                $imagem = $novoNome;
            }
        }
    }

    // Atualizar post
    $sql = "UPDATE posts SET titulo = ?, conteudo = ?, autor = ?, categoria_id = ?, imagem = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi", $titulo, $conteudo, $autor, $categoria_id, $imagem, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=atualizado");
        exit;
    } else {
        include '../includes/cabecalho.php';
        echo "<p style='color:red;'>Erro ao atualizar o post: " . $conn->error . "</p>";
        include '../includes/rodape.php';
        exit;
    }
}

// 🔽 Só inclui HTML depois de toda a lógica
include '../includes/cabecalho.php';
?>

<main class="dashboard">
    <h2>Editar Post</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($post['titulo']); ?>" required><br>
        
        <label for="conteudo">Conteúdo:</label><br>
        <textarea name="conteudo" id="conteudo" rows="5" required><?php echo htmlspecialchars($post['conteudo']); ?></textarea><br>
        
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" required>
            <?php while ($cat = $res_categorias->fetch_assoc()): ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $post['categoria_id']) ? "selected" : ""; ?>>
                    <?php echo htmlspecialchars($cat['nome']); ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        
        <p>Imagem atual:</p>
        <?php if (!empty($post['imagem'])): ?>
            <img src="../assets/img/<?php echo htmlspecialchars($post['imagem']); ?>" width="120" alt="Imagem atual">
        <?php else: ?>
            <em>Nenhuma imagem</em>
        <?php endif; ?>
        
        <br><label for="imagem">Nova Imagem:</label>
        <input type="file" name="imagem" id="imagem" accept=".jpg,.jpeg,.png,.gif"><br><br>
        
        <button type="submit">💾 Salvar</button>
    </form>
</main>

<?php include '../includes/rodape.php'; ?>
