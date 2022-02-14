<?php
// Puxar o arquivo de conexão com o banco de dados:
include('db/banco.php');

// Verificar se a pessoa está acessando a página diretamente:
if(!isset($_POST['cadNome']) && !isset($_POST['cadUsername']) && !isset($_POST['cadEmail'])){
    // Devolver o jovem pra tela de login:
    header("Location: index.php");
}else{
    if($_POST['cadSenha1'] == $_POST['cadSenha2']){

        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO usuarios (username, senha, email, nomeCompleto) VALUES (?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($_POST['cadUsername'], $_POST['cadSenha1'], $_POST['cadEmail'], $_POST['cadNome']));
        Banco::desconectar();

        // Devolver o usuário para tela de login:
        header("Location: index.php?sucesso=1");
    }else{
        // Devolver o jovem pra tela de login:
        header("Location: index.php");
    }
    

}





?>