<?php
// Pendente de validação de erros !!! 

// Iniciar utilização de sessão:
session_start();
include('db/banco.php');
// Verificar se o usuário não está logado:

    $status = ["status" => 0, "mensagem" => "0", "dados" => 0];
    // Verificar se o usuário não está logado:
    if (!isset($_SESSION['infosusuario'])) {
        // Redirecionar de volta à tela de login:
       // header('Location: ../index.php');
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        $status["status"] = 0;
        $status["mensagem"] = "Acesso permitido apenas para usuários autenticados.";
        echo json_encode($status);
        exit();
     } 
    
    

// Verificar se a pessoa está logada:

// Puxar o arquivo de conexão com o banco de dados:


// Definir fuso horário:
date_default_timezone_set('America/Sao_Paulo');

// Verificar se nome e/ou código de barras não está vazios:
if ($_POST['codBarras'] != "" && $_POST['nome'] != "" && strlen($_POST['codBarras']) == 5) {
    $codbarras = $_POST['codBarras'];
    $nome = $_POST['nome'];
} else {
   // header("Location: index.php?msg=3");
   header('Content-Type: application/json; charset=utf-8');
   http_response_code(200);
   $status["status"] = 0;
   $status["mensagem"] = "erro!.";
   echo json_encode($status);
    exit();
}


// Verificar se está chegando um valor inteiro/float pelo post
if (intval($_POST['preco']) != 0) {
    $preco = $_POST['preco'];
} else {
   // header("Location: index.php?msg=3");
   header('Content-Type: application/json; charset=utf-8');
   http_response_code(200);
   $status["status"] = 0;
   $status["mensagem"] = "Verificar se as informações estão .";
   echo json_encode($status);
    exit();
}

// Verificar se está chegando um valor inteiro pelo post
if (floatval($_POST['qtdEstoque']) != 0) {
    $qtdEstoque = $_POST['qtdEstoque'];
} else {
   // header("Location: index.php?msg=3");
   header('Content-Type: application/json; charset=utf-8');
   http_response_code(200);
   $status["status"] = 0;
   $status["mensagem"] = "Verificar as Informações.";
   echo json_encode($status);
    exit();
}


$categoria = $_POST['categoria'];
// Obter o ID do usuário pela sessão atual:
$idResp = $_SESSION['infosusuario']['idUsuario'];

$foto = "fotos/semfoto.jpg";


// Caso a foto não esteja definida, setar para fotos/semfoto.jpg
try {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO produtos (codbarras, nome, preco, estoque, idCategoria, idRespCadastro, foto) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($codbarras, $nome, $preco, $qtdEstoque, $categoria, $idResp, $foto));
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(200);
    $status["status"] = 1;
    $status["mensagem"] = "Sucesso.";
    echo json_encode($status);
        exit();
} catch (PDOException $e) {
    Banco::desconectar();
    if ($e->getCode() == 23000) {
       // header("Location: index.php?msg=4");
       header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        $status["status"] = 0;
        $status["mensagem"] = "Erro de Banco de dados.";
        echo json_encode($status);
            exit();
    } else {
        //header("Location: index.php?msg=3");
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        $status["status"] = 0;
        $status["mensagem"] = "Acesso permitido apenas para usuários autenticados.";
        echo json_encode($status);
        exit();
    }
}

Banco::desconectar();

// Devolver o usuário para tela de administração:
//header("Location: index.php?msg=1");