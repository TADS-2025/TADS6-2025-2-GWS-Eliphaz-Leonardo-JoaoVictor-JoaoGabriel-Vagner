<?php
session_start();
include '../includes/conexao.php';
include '../includes/cabecalho.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Buscar usuário pelo email
    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na query: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Confere senha (funciona tanto para password_hash quanto para MD5 no seu caso)
        if (password_verify($senha, $user['senha']) || $user['senha'] === md5($senha)) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<p style='color:red'>Senha incorreta!</p>";
        }
    } else {
        echo "<p style='color:red'>Usuário não encontrado!</p>";
    }
    $stmt->close();
}
?>

<div class="login-container">
    <h2>Login do Administrador</h2>
    <form method="post">
        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email" required>
        
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        
        <button type="submit">Entrar</button>
    </form>
</div>

<?php
include '../includes/rodape.php';
?>
