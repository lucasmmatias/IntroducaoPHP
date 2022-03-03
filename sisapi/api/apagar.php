<?php
// Iniciar sessão:
session_start();

$status = ["status" => 0, "mensagem" => "0", "dados" => 0];
// Verificar se o usuário não está logado:
if (!isset($_SESSION['infosusuario'])) {
    // Redirecionar de volta à tela de login:
   // header('Location: ../index.php');
   header('Content-Type: application/json; charset=utf-8');
   http_response_code(200);
   $status["status"] = 0;
   $status["mensagem"] = "Usuário não está autenticado.";
   echo json_encode($status);
   exit();

} else {
    // Continar caso o usuário esteja logado:
    // Importar o banco.php
     require 'db/banco.php';

    // Variável para armazenar o CODBarras do produto a ser removido:
    // apagar.php?id=21545
    $item = $_POST['codBarras'];
    //echo 'Você vai apagar o item ' .$item;

    // Antes de apagar, devemos verificar se o usuário é os resp pelo cadastro:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT idRespCadastro FROM produtos WHERE codbarras = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($item));
    // Resultado do BD:
    $data = $q->fetch(PDO::FETCH_ASSOC);
    // Verificar se o banco devolveu algum resultado:
    if (!is_array($data)) {
       // header("Location: index.php?msg=3");
       header('Content-Type: application/json; charset=utf-8');
            http_response_code(200);
            $status["status"] = 0;
            $status["mensagem"] = "Erro!.";
            echo json_encode($status);
            Banco::desconectar();   
            exit();


         
    } else {
        // Se idUsuario == idRespCadastro e devo apagar o produto:
        if ($_SESSION['infosusuario']['idUsuario'] == $data['idRespCadastro']) {
            $sql = "DELETE FROM produtos WHERE codbarras = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($item));
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(200);
            $status["status"] = 1;
            $status["mensagem"] = "Sucesso.";
            echo json_encode($status);
            Banco::desconectar();   
            exit();
            
            // Redirecionar de volta ao painel:
           // header("Location: index.php?msg=0");


        } else {
            
            //echo "Este produto não te pertence!";
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(200);
            $status["status"] = 0;
            $status["mensagem"] = "Este produto não te pertence!.";
            echo json_encode($status);
            Banco::desconectar();    
            exit();
                
        }
        Banco::desconectar();
    }
}
