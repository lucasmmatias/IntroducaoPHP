<?php
// Pendente de validação de erros !!! 
// Iniciar utilização de sessão:
session_start();
// Verificar se o usuário não está logado:

$status = ["status" => 0, "mensagem" => "0", "dados" => 0];

if (!isset($_SESSION['infosusuario'])) {
    // Redirecionar de volta à tela de login:
    //header('Location: ../index.php');
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(200);
    $status["status"] = 0;
    $status["mensagem"] = "Usuário não está autenticado.";
    echo json_encode($status);
    exit();
}
// Puxar o arquivo de conexão com o banco de dados:
include('db/banco.php');

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Obter as informações do produto e verificar se ele pertence ao usuário logado:
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT idRespCadastro FROM produtos WHERE codbarras = ?";
$q = $pdo->prepare($sql);
$q->execute(array($_POST['idProduto']));
// header('Content-Type: application/json; charset=utf-8');
//     http_response_code(200);
//     $status["status"] = 1;
//     $status["mensagem"] = "Sucesso.";
//     echo json_encode($status);
//         exit();
// Resultado do BD:
$data = $q->fetch(PDO::FETCH_ASSOC);
if ($data['idRespCadastro'] != $_SESSION['infosusuario']['idUsuario']) {
    //echo 'Este produto não te pertence';
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(200);
    $status["status"] = 0;
    $status["mensagem"] = "Este produto não te pertence.";
    echo json_encode($status);
    Banco::desconectar();
    exit();
   
} else {
    // Definir fuso horário:
    date_default_timezone_set('America/Sao_Paulo');
    $idproduto = $_POST['idProduto'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $idCategoria = $_POST['idCategoria'];
    // Obter o ID do usuário pela sessão atual:
    $idResp = $_SESSION['infosusuario']['idUsuario'];

    $sql = "UPDATE produtos SET codbarras = ?, nome = ?, preco = ?, estoque = ?, idCategoria = ? WHERE codbarras = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($idproduto, $nome, $preco, $estoque, $idCategoria, $idproduto));
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(200);
    $status["status"] = 1;
    $status["mensagem"] = "Sucesso.";
    echo json_encode($status);
    Banco::desconectar();    
    exit();
    
    // Devolver o usuário para tela de administração:
  //  header("Location: index.php?msg=2");
}
?>

