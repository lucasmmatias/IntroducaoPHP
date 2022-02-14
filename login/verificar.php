<?php
// Importar o arquivo banco.php:
include('db/banco.php');
// Inicar a sessão:
session_start();

// Verificar se a pessoa está acessando a página por POST:
if(!isset($_POST['username']) && !isset($_POST['password'])){
    // Mostrar mensagem de erro:
    echo "Tá errado, parsa";
}else{
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

    // Sugestão: exibir os resultados vindos do banco:
    // print_r($data);

    // Verificar se a senha está correta:
        if($_POST['password'] == $data['senha']){
            echo "Acertô, mizeravi.";
        }else{
            echo "Errou, mizeravi.";
        }
    
}


// // Verificar a senha:
// if($_POST['password'] == "soares"){
//     echo "Beleza!";
//     // Criar os cookies de sessão:
//     $_SESSION['user'] = $_POST['username'];
//     $_SESSION['senha'] = $_POST['password'];
//     // Redirecionar para a pág inicial do sistema:
//     header("Location: sistema/index.php");
// }

?>