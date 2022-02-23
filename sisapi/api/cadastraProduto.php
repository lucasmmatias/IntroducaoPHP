<?php
// Pendente de validação de erros !!! 

// Iniciar utilização de sessão:
session_start();
// Verificar se o usuário não está logado:
if (!isset($_SESSION['infosusuario'])) {
    // Redirecionar de volta à tela de login:
    header('Location: ../index.php');
}

// Verificar se a pessoa está logada:

// Puxar o arquivo de conexão com o banco de dados:
include('../db/banco.php');

// Definir fuso horário:
date_default_timezone_set('America/Sao_Paulo');

// Verificar se nome e/ou código de barras não está vazios:
if ($_POST['codBarras'] != "" && $_POST['nome'] != "" && strlen($_POST['codBarras']) == 5) {
    $codbarras = $_POST['codBarras'];
    $nome = $_POST['nome'];
} else {
    header("Location: index.php?msg=3");
    exit();
}


// Verificar se está chegando um valor inteiro/float pelo post
if (intval($_POST['preco']) != 0) {
    $preco = $_POST['preco'];
} else {
    header("Location: index.php?msg=3");
    exit();
}

// Verificar se está chegando um valor inteiro pelo post
if (floatval($_POST['qtdEstoque']) != 0) {
    $qtdEstoque = $_POST['qtdEstoque'];
} else {
    header("Location: index.php?msg=3");
    exit();
}


$categoria = $_POST['categoria'];
// Obter o ID do usuário pela sessão atual:
$idResp = $_SESSION['infosusuario']['idUsuario'];

// Upload de Arquivos:

// Valor aleatório: rand(inicial,final);
// 20211214160617_XXXX
$novoNome = date('YmdHis') . "_" . rand(1000, 9999);
// Extrair a extensão do arquivo enviado:
$ext = substr($_FILES['foto']['name'], -4);
// Definir o novo nome do arquivo com a extensão:
$novoNome = $novoNome . $ext;

// Mover e verificar se deu certo:
if (move_uploaded_file($_FILES['foto']['tmp_name'], "fotos/" . $novoNome)) {
    $foto = "fotos/" . $novoNome;
} else {
    $foto = "fotos/semfoto.jpg";
}

// Caso a foto não esteja definida, setar para fotos/semfoto.jpg
try {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO produtos (codbarras, nome, preco, estoque, idCategoria, idRespCadastro, foto) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($codbarras, $nome, $preco, $qtdEstoque, $categoria, $idResp, $foto));
} catch (PDOException $e) {
    Banco::desconectar();
    if ($e->getCode() == 23000) {
        header("Location: index.php?msg=4");
        exit();
    } else {
        header("Location: index.php?msg=3");
        exit();
    }
}

Banco::desconectar();

// Devolver o usuário para tela de administração:
header("Location: index.php?msg=1");
