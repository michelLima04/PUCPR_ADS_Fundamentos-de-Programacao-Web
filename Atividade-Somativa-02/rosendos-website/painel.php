<?php
session_start();
require 'conexao.php'; // Conecta ao banco

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
}

// Cadastrar novos Produtos
// Verifica se o formulário de cadastro foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar_produto'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $id_categoria = $_POST['id_categoria'];

    // Monta a query para inserir no banco
    $sql_insert = "INSERT INTO produtos (nome, preco, id_categoria) VALUES ('$nome', '$preco', '$id_categoria')";
    
    if ($conn->query($sql_insert) === TRUE) {
        // Se deu certo, recarrega a página para limpar o formulário e atualizar a tabela
        header("Location: painel.php");
        exit;
    } else {
        $erro_cadastro = "Erro ao cadastrar: " . $conn->error;
    }
}

// Busca os Produtos no Banco
$sql = "SELECT p.id, p.nome, p.preco, c.nome as categoria 
        FROM produtos p 
        LEFT JOIN categorias c ON p.id_categoria = c.id";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel - Rosendo's</title>
</head>
<body>
    <h2>Bem-vindo(a), <?php echo $_SESSION['nome_usuario']; ?>!</h2>
    <a href="logout.php"><button style="background-color: #ff4d4d; color: white;">Sair do Sistema</button></a>
    <hr>

    <h3>Cadastrar Novo Produto</h3>
    
    <?php if(isset($erro_cadastro)) echo "<p style='color:red;'>$erro_cadastro</p>"; ?>

    <form method="POST" action="painel.php">
        <label>Nome do Produto:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Preço (use ponto em vez de vírgula. Ex: 12.50):</label><br>
        <input type="number" step="0.01" name="preco" required><br><br>

        <label>Categoria:</label><br>
        <select name="id_categoria" required>
            <option value="1">Pão de Mel</option>
            <option value="2">Kits e Caixas</option>
        </select><br><br>

        <button type="submit" name="cadastrar_produto">Salvar Produto</button>
    </form>

    <hr>

    <h3>Lista de Produtos</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Ações</th> 
        </tr>
        <?php 
        if ($resultado->num_rows > 0) {
            while($produto = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>".$produto['id']."</td>
                        <td>".$produto['nome']."</td>
                        <td>R$ ".number_format($produto['preco'], 2, ',', '.')."</td>
                        <td>".$produto['categoria']."</td>
                        <td>
                            <a href='editar.php?id=".$produto['id']."'>Editar</a> | 
                            <a href='deletar.php?id=".$produto['id']."' onclick=\"return confirm('Tem certeza que deseja excluir este produto?');\">Excluir</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum produto cadastrado.</td></tr>";
        }
        ?>
    </table>
</body>
</html>