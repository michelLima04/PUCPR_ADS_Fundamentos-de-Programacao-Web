<?php
// Inicia a sessão e conecta ao banco
session_start();
require 'conexao.php';

// Proteção: Garante que só quem está logado pode acessar
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
}

// Salvar a Edição dos Dados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atualizar_produto'])) {
    // Recebe os dados novos digitados no formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $id_categoria = $_POST['id_categoria'];

    // Monta o comando UPDATE
    $sql_update = "UPDATE produtos SET nome='$nome', preco='$preco', id_categoria='$id_categoria' WHERE id=$id";
    
    // Executa e redireciona
    if ($conn->query($sql_update) === TRUE) {
        header("Location: painel.php");
        exit;
    } else {
        $erro = "Erro ao atualizar: " . $conn->error;
    }
}

// Carregar os Dados atualizados
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Busca os dados do produto específico
    $sql = "SELECT * FROM produtos WHERE id = $id";
    $resultado = $conn->query($sql);
    
    if ($resultado->num_rows > 0) {
        $produto = $resultado->fetch_assoc();
    } else {
        // Se o ID não existir no banco, volta pro painel
        header("Location: painel.php");
        exit;
    }
} else {
    // Se tentou acessar a página direto sem passar ID na URL, volta pro painel
    header("Location: painel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto - Rosendo's</title>
</head>
<body>
    <h2>Editar Produto</h2>
    <hr>
    
    <?php if(isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

    <form method="POST" action="editar.php">
        
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

        <label>Nome do Produto:</label><br>
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="<?php echo $produto['preco']; ?>" required><br><br>

        <label>Categoria:</label><br>
        <select name="id_categoria" required>
            <option value="1" <?php if($produto['id_categoria'] == 1) echo 'selected'; ?>>Pão de Mel</option>
            <option value="2" <?php if($produto['id_categoria'] == 2) echo 'selected'; ?>>Kits e Caixas</option>
        </select><br><br>

        <button type="submit" name="atualizar_produto">Salvar Alterações</button>
        <a href="painel.php"><button type="button">Cancelar</button></a>
    </form>
</body>
</html>