<?php
// Pendente de validação de erros !!! 
// Iniciar utilização de sessão:
session_start();

// Puxar o arquivo de conexão com o banco de dados:
include('../db/banco.php');

// Definir fuso horário:
date_default_timezone_set('America/Sao_Paulo');

$codbarras = $_POST['codBarras'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$qtdEstoque = $_POST['qtdEstoque'];
$categoria = $_POST['categoria'];
// Obter o ID do usuário pela sessão atual:
$idResp = $_SESSION['infosusuario']['idUsuario'];

// Upload de Arquivos:

// Valor aleatório: rand(inicial,final);
// 20211214160617_XXXX
$novoNome = date('YmdHis')."_".rand(1000,9999);
// Extrair a extensão do arquivo enviado:
$ext = substr($_FILES['foto']['name'],-4);
// Definir o novo nome do arquivo com a extensão:
$novoNome = $novoNome . $ext;

// Mover e verificar se deu certo:
if(move_uploaded_file($_FILES['foto']['tmp_name'], "fotos/".$novoNome)){
    $foto = "fotos/".$novoNome;
}
else{
    $foto = "fotos/semfoto.jpg";
}

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