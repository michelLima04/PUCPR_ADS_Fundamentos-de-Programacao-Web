<?php
// 1. Inicia a sessão e conecta ao banco
session_start();
require 'conexao.php';

// 2. Proteção: Garante que só quem está logado pode excluir algo
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
}

// 3. Verifica se o ID foi enviado pela URL (método GET)
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    // 4. Monta e executa o comando SQL de exclusão
    $sql_delete = "DELETE FROM produtos WHERE id = $id_produto";
    $conn->query($sql_delete);
}

// 5. Redireciona de volta para o painel, independentemente de ter dado certo ou não
header("Location: painel.php");
exit;
?>