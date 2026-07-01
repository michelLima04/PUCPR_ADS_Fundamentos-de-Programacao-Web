<?php
// 1. Inclui o arquivo de conexão
require 'conexao.php';

// 2. Verifica se o usuário clicou no botão "Cadastrar" (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // 3. CRIPTOGRAFIA: Transforma a senha em um código seguro (Requisito da Somativa)
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // 4. Monta o comando SQL de INSERT
    $sql = "INSERT INTO usuarios (nome, login, senha) VALUES ('$nome', '$login', '$senha_criptografada')";

    // 5. Executa o comando e verifica se deu certo
    if ($conn->query($sql) === TRUE) {
        $mensagem = "<p style='color: green;'>Usuário cadastrado com sucesso! Agora você pode fazer login.</p>";
    } else {
        $mensagem = "<p style='color: red;'>Erro ao cadastrar: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Rosendo's</title>
</head>
<body>
    <h2>Cadastro de Administrador</h2>
    
    <?php if(isset($mensagem)) echo $mensagem; ?>

    <form method="POST" action="cadastro.php">
        <label>Nome Completo:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Login de acesso:</label><br>
        <input type="text" name="login" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>