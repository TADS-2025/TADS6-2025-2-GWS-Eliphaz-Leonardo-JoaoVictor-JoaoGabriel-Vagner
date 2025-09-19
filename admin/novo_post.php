<?php
include '../includes/cabecalho.php';
session_start();
include '../includes/conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $conteudo = $conn->real_escape_string($_POST['conteudo']);
    $autor = $conn->real_escape_string($_POST['autor']);
    $categoria_id = intval($_POST['categoria']);

    // Upload da imagem
    $imagem = $_FILES['imagem']['name'];
    $tmp = $_FILES['imagem']['tmp_name'];
    move_uploaded_file($tmp, "../assets/img/" . $imagem);

    $sql = "INSERT INTO posts (titulo, conteudo, imagem, autor, categoria_id)
            VALUES ('$titulo', '$conteudo', '$imagem', '$autor', $categoria_id)";
    $conn->query($sql);

    header("Location: dashboard.php");
}

?>

    <h2>Novo Post</h2>
    <form method="post" enctype="multipart/form-data">
        Título: <input type="text" name="titulo"><br>
        Conteúdo:<br><textarea name="conteudo"></textarea><br>
        Autor: <input type="text" name="autor"><br>
        Categoria:
        <select name="categoria">
            <?php
            $res = $conn->query("SELECT * FROM categorias");
            while ($cat = $res->fetch_assoc()) {
                echo "<option value='{$cat['id']}'>{$cat['nome']}</option>";
            }
            
            ?>
        </select><br>
        Imagem: <input type="file" name="imagem"><br>
        <button type="submit">Publicar</button>

    </form>

    <?php
include '../includes/rodape.php'; // Adicione esta linha
?>