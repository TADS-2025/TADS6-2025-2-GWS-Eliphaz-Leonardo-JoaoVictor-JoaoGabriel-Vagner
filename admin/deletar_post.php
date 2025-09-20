<?php
session_start();
include '../includes/conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id']);
$conn->query("DELETE FROM posts WHERE id=$id");
header("Location: dashboard.php");
