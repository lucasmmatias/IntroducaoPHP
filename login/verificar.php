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
        echo $e->getMessage();
    }    

        // Sugestão: exibir os resultados vindos do banco:
        // print_r($data);
        
        //Obter o hash da senha digitada:
        $hashdasenha = hash("SHA256", $_POST['password']);
        // Verificar se a senha está correta comparando seu HASH com o do BD:
            if($hashdasenha == $data['senha']){
                // Criar sessão com as informações de login:
                $_SESSION['infosusuario'] = $data;
                // Redirecionar o boneco para a página do sistema:
                header('Location: sistema/index.php');
            }else{
                header('Location: index.php?msg=4');
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