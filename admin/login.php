<?php
session_start();
include '../includes/conexao.php';
include '../includes/cabecalho.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

        $sql = "SELECT senha FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['usuario'] = $usuario;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
    $stmt->close();
}
?>

<div class="login-container">
    <h2>Login do Administrador</h2>
    <form method="post">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <button type="submit">Entrar</button>
    </form>
</div>
<?php
include '../includes/rodape.php'; // Adicione esta linha
?>

