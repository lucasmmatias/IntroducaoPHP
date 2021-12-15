<?php
// Inicar a sessão:
session_start();

// Verificar a senha:
if($_POST['password'] == "soares"){
    echo "Beleza!";
    // Criar os cookies de sessão:
    $_SESSION['user'] = $_POST['username'];
    $_SESSION['senha'] = $_POST['password'];
    // Redirecionar para a pág inicial do sistema:
    header("Location: sistema/index.php");
}

?>