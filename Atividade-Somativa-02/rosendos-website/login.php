<?php
// 1. Inicia a sessão (o sistema de "crachás") ANTES de qualquer código HTML
session_start();

// 2. Chama a conexão com o banco
require 'conexao.php';

// 3. Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha_digitada = $_POST['senha'];

    // 4. Busca no banco de dados se existe algum usuário com esse login
    $sql = "SELECT * FROM usuarios WHERE login = '$login'";
    $resultado = $conn->query($sql);

    // 5. Se encontrou o usuário...
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        // 6. Compara a senha que a pessoa digitou com a senha criptografada do banco
        if (password_verify($senha_digitada, $usuario['senha'])) {
            
            // Senha correta! Entrega o "crachá" gravando os dados na sessão
            $_SESSION['logado'] = true;
            $_SESSION['nome_usuario'] = $usuario['nome'];
            
            // Redireciona a pessoa para a página secreta (que vamos criar no próximo passo)
            header("Location: painel.php"); 
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Rosendo's Delícias Artesanais</title>
</head>
<body>
    <h2>Acesso Restrito - Área Administrativa</h2>
    
    <?php if(isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

    <form method="POST" action="login.php">
        <label>Login:</label><br>
        <input type="text" name="login" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Entrar no Sistema</button>
    </form>
</body>
</html>