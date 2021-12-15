<?php
session_start();
// Verificar se a pessoa não possui a sessão:
if(!isset($_SESSION['user']) && !isset($_SESSION['senha'])){
    // Redirecionar de volta à tela de login:
    header('Location: ../index.php');
}

echo "Olá ". $_SESSION['user'];
?>