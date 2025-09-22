<?php
session_start();
include '../includes/conexao.php';
include '../includes/cabecalho.php';

// Verificar login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $conteudo = trim($_POST['conteudo']);
    $autor = $_SESSION['usuario_nome']; // Pega o nome do usuário logado
    $categoria_id = intval($_POST['categoria']);
    $imagem = null;

    // Upload da imagem (com validação simples)
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

    // Inserir no banco (prepared statement)
    $sql = "INSERT INTO posts (titulo, conteudo, imagem, autor, categoria_id) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $titulo, $conteudo, $imagem, $autor, $categoria_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=sucesso");
        exit;
    } else {
        echo "<p style='color:red'>Erro ao publicar: " . $conn->error . "</p>";
    }

    $stmt->close();
}
?>

<main class="dashboard">
    <h2>Novo Post</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br>

        <label for="conteudo">Conteúdo:</label>
        <textarea name="conteudo" id="conteudo" rows="5" required></textarea><br>

        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" required>
            <?php
            $res = $conn->query("SELECT * FROM categorias ORDER BY nome ASC");
            while ($cat = $res->fetch_assoc()) {
                echo "<option value='{$cat['id']}'>" . htmlspecialchars($cat['nome']) . "</option>";
            }
            ?>
        </select><br>

        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" id="imagem" accept=".jpg,.jpeg,.png,.gif"><br>

        <button type="submit">📌 Publicar</button>
    </form>
</main>

<?php
include '../includes/rodape.php';
?>
