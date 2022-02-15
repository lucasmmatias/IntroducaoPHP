<?php
// Pendente de validação de erros !!! 

// Puxar o arquivo de conexão com o banco de dados:
include('../db/banco.php');

// Iniciar utilização de sessão:
session_start();

$codbarras = $_POST['codBarras'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$qtdEstoque = $_POST['qtdEstoque'];
$categoria = $_POST['categoria'];
// Obter o ID do usuário pela sessão atual:
$idResp = $_SESSION['infosusuario']['idUsuario'];

$foto = "";
// Caso a foto não esteja definida, setar para fotos/semfoto.jpg

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO produtos (codbarras, nome, preco, estoque, idCategoria, idRespCadastro, foto) VALUES (?, ?, ?, ?, ?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($codbarras, $nome, $preco, $qtdEstoque, $categoria, $idResp, $foto));
Banco::desconectar();

// Devolver o usuário para tela de administração:
header("Location: index.php?msg=2");

?>