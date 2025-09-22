<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../includes/conexao.php';

$erro = "";

// Se já está logado → manda pro dashboard direto
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Confere tanto hash moderno quanto md5 (compatibilidade)
            if (password_verify($senha, $user['senha']) || $user['senha'] === md5($senha)) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nome'] = $user['nome'];

                header("Location: dashboard.php");
                exit;
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "Usuário não encontrado!";
        }
        $stmt->close();
    } else {
        $erro = "Erro na query: " . $conn->error;
    }
}
?>

<?php include '../includes/cabecalho.php'; ?>

<div class="login-container">
    <h2>Login do Administrador</h2>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post">
        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email" required>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>

        <button type="submit">Entrar</button>
    </form>
</div>

<?php include '../includes/rodape.php'; ?>
