<?php
session_start();
include '../includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Usando prepared statement para evitar injeção de SQL
    $sql = "SELECT senha FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verifica se a senha fornecida corresponde ao hash no banco de dados
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

<form method="post">
    Usuário: <input type="text" name="usuario"><br>
    Senha: <input type="password" name="senha"><br>
    <button type="submit">Entrar</button>
</form>