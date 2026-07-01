<?php
// 1. Inicia a sessão para ter acesso a ela
session_start();

// 2. Destrói todos os dados registrados na sessão atual
session_destroy();

// 3. Redireciona o usuário de volta para a tela de login
header("Location: login.php");
exit;
?>