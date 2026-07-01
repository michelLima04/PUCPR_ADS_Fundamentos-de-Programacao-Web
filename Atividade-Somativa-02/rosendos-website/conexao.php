<?php

// Configurações do servidor local 
$servidor = "localhost";
$usuario = "root";
$senha = ""; 
$banco = "bd_rosendos";

// Função que cria a conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Conicional que verifica se houve erros na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
