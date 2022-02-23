<?php
// Importar o arquivo banco.php:
include('db/banco.php');
// Inicar a sessão:
session_start();

// Array de Status:
$status = ["status" => 0, "mensagem" => "0"];

// Verificar se a pessoa está acessando a página por POST:
if(!isset($_POST['username']) && !isset($_POST['password'])){
    // Retornar json com erro:
    http_response_code(400);
    header('Content-Type: application/json; charset=utf-8');
    $status["mensagem"] = "Acesso permitido apenas por POST.";
    echo json_encode($status);
}else{
    try{
        // Caso esteja tudo setado, vamos começar a usar o BD:
        $pdo = Banco::conectar(); // conectando ao BD
        // Definir o tipo de execução em caso de erro:
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Comando que iremos executar no BD:
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($_POST['username']));
        // Resultado do BD:
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Banco::desconectar();
    }catch(PDOException $e){
        // Em caso de erro na consulta ao banco:
        http_response_code(500);
        header('Content-Type: application/json; charset=utf-8');
        $status["mensagem"] = "Houve um erro no servidor.";
        echo json_encode($status);
    } 
        
        //Obter o hash da senha digitada:
        $hashdasenha = hash("SHA256", $_POST['password']);
        // Verificar se a senha está correta comparando seu HASH com o do BD:
            if($hashdasenha == $data['senha']){
                // Criar sessão com as informações de login:
                $_SESSION['infosusuario'] = $data;
                http_response_code(200);
                header('Content-Type: application/json; charset=utf-8');
                $status["mensagem"] = "OK.";
                $status["status"] = 1;
                echo json_encode($status);
            }else{
                http_response_code(400);
                header('Content-Type: application/json; charset=utf-8');
                $status["mensagem"] = "Usuário ou senha inválidos.";
                echo json_encode($status);
            }
}

?>