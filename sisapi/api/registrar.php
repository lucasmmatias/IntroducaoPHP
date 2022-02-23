<?php
// Puxar o arquivo de conexão com o banco de dados:
include('db/banco.php');

$status = ["status" => 0, "mensagem" => "0"];

// Verificar se a pessoa está acessando a página diretamente:
if(!isset($_POST['cadNome']) && !isset($_POST['cadUsername']) && !isset($_POST['cadEmail'])){
     // Retornar json com erro:
     http_response_code(400);
     header('Content-Type: application/json; charset=utf-8');
     $status["mensagem"] = "Acesso permitido apenas por POST.";
     echo json_encode($status);
}else{
    if($_POST['cadSenha1'] == $_POST['cadSenha2']){
        // Criar o HASH da senha:
        $hashdasenha = hash("SHA256", $_POST['cadSenha1']);


        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO usuarios (username, senha, email, nomeCompleto) VALUES (?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($_POST['cadUsername'], $hashdasenha, $_POST['cadEmail'], $_POST['cadNome']));
        Banco::desconectar();

        http_response_code(200);
        header('Content-Type: application/json; charset=utf-8');
        $status["mensagem"] = "Cadastro realizado com sucesso!";
        $status["status"] = 1;
        echo json_encode($status);
    }else{
        // Retornar json com erro:
        http_response_code(200);
        header('Content-Type: application/json; charset=utf-8');
        $status["mensagem"] = "As senhas não conferem.";
        echo json_encode($status);
    }
    

}





?>