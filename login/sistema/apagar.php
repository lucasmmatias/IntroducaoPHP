<?php
// Iniciar sessão:
session_start();
// Importar o banco.php
require '../db/banco.php';
// Variável para armazenar o CODBarras do produto a ser removido:
// apagar.php?id=21545
$item = $_GET['id'];
//echo 'Você vai apagar o item ' .$item;

// Bangs do banco de dados:
$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM produtos WHERE codbarras = ?";
$q = $pdo->prepare($sql);
$q->execute(array($item));
Banco::desconectar();

// Redirecionar de volta ao painel:
header("Location: index.php?msg=1");

?>