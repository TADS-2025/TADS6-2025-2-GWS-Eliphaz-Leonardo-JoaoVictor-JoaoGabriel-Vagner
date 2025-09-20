<?php
session_start();
include '../includes/conexao.php';
include '../includes/cabecalho.php'; 

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id']);
$post = $conn->query("SELECT * FROM posts WHERE id=$id")->fetch_assoc();
$res_categorias = $conn->query("SELECT * FROM categorias");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $conteudo = $conn->real_escape_string($_POST['conteudo']);
    $autor = $conn->real_escape_string($_POST['autor']);
    
    // Verificação para garantir que a categoria existe e é um número inteiro
    $categoria_id = isset($_POST['categoria']) ? intval($_POST['categoria']) : null;

    if ($categoria_id === null || $categoria_id === 0) {
        echo "<p style='color:red;'>Erro: A categoria selecionada é inválida.</p>";
    } else {
        if (!empty($_FILES['imagem']['name'])) {
            $imagem = $_FILES['imagem']['name'];
            $tmp = $_FILES['imagem']['tmp_name'];
            move_uploaded_file($tmp, "../assets/img/" . $imagem);
            $sql = "UPDATE posts SET titulo='$titulo', conteudo='$conteudo', autor='$autor', categoria_id=$categoria_id, imagem='$imagem' WHERE id=$id";
        } else {
            $sql = "UPDATE posts SET titulo='$titulo', conteudo='$conteudo', autor='$autor', categoria_id=$categoria_id WHERE id=$id";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<p style='color:red;'>Erro ao atualizar o post: " . $conn->error . "</p>";
        }
    }
}
?>

<h2>Editar Post</h2>
<form method="post" enctype="multipart/form-data">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($post['titulo']); ?>"><br>
    
    <label for="conteudo">Conteúdo:</label><br>
    <textarea name="conteudo" id="conteudo"><?php echo htmlspecialchars($post['conteudo']); ?></textarea><br>
    
    <label for="autor">Autor:</label>
    <input type="text" name="autor" id="autor" value="<?php echo htmlspecialchars($post['autor']); ?>"><br>
    
    <label for="categoria">Categoria:</label>
    <select name="categoria" id="categoria">
        <?php
        while ($cat = $res_categorias->fetch_assoc()) {
            $sel = ($cat['id'] == $post['categoria_id']) ? "selected" : "";
            echo "<option value='{$cat['id']}' $sel>{$cat['nome']}</option>";
        }
        ?>
    </select><br>
    
    <p>Imagem atual: <img src="../assets/img/<?php echo htmlspecialchars($post['imagem']); ?>" width="100"></p>
    
    <label for="imagem">Nova Imagem:</label>
    <input type="file" name="imagem" id="imagem"><br>
    
    <button type="submit">Salvar</button>
</form>

<?php
include '../includes/rodape.php'; 
?>