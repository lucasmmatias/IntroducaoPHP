<?php

error_reporting(E_ALL ^ E_WARNING); 
// Importar o arquivo banco.php:
include('db/banco.php');
// Inicar a sessão:
session_start();

// Array de Status:
$status = ["status" => 0, "mensagem" => "0", "dados" => 0];

// Verificar se o usuario está logado:
if(!isset($_SESSION['infosusuario'])){
    http_response_code(200);
    header('Content-Type: application/json; charset=utf-8');
    $status["mensagem"] = "Acesso permitido apenas para usuários autenticados.";
    echo json_encode($status);
}else{
    // Se estiver logado, vamos buscar as infos no banco:
    try{
        // Caso esteja tudo setado, vamos começar a usar o BD:
        $pdo = Banco::conectar(); // conectando ao BD
        // Definir o tipo de execução em caso de erro:
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Comando que iremos executar no BD:
        $sql = "SELECT username, idUsuario, email, nomeCompleto FROM usuarios WHERE idUsuario = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['infosusuario']['idUsuario']));
        // Resultado do BD:
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Banco::desconectar();
        // Devolver as informações do usuário por JSON:
            http_response_code(200);
            header('Content-Type: application/json; charset=utf-8');
            $status['status'] = 1;
            $status['mensagem'] = "Sucesso!";
            $status['dados'] = $data;
            echo json_encode($status);

    }catch(PDOException $e){
        // Em caso de erro na consulta ao banco:
        Banco::desconectar();
        http_response_code(200);
        header('Content-Type: application/json; charset=utf-8');
        $status["mensagem"] = "Houve um erro no servidor.";
        echo json_encode($status);
    } 
}

?>