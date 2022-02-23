
<?php

// Pendente de validação de erros !!! 

// Iniciar utilização de sessão:
session_start();
// Verificar se o usuário não está logado:
if(!isset($_SESSION['infosusuario'])){
    // Redirecionar de volta à tela de login:
    header('Location: ../index.php');
}
// Puxar o arquivo de conexão com o banco de dados:
include('../db/banco.php');

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Obter as informações do produto e verificar se ele pertence ao usuário logado:
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT idRespCadastro FROM produtos WHERE codbarras = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['idProduto']));
     // Resultado do BD:
    $data = $q->fetch(PDO::FETCH_ASSOC);
    if($data['idRespCadastro'] != $_SESSION['infosusuario']['idUsuario']){
        echo 'Este produto não te pertence';
        Banco::desconectar();
        exit();
    }else{
        // Definir fuso horário:
        date_default_timezone_set('America/Sao_Paulo');
        $codbarras = $_POST['codbarras'];
        $idproduto = $_POST['idProduto'];
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $estoque = $_POST['estoque'];
        $idCategoria = $_POST['idCategoria'];
        $foto = $_FILES['foto'];
        // Obter o ID do usuário pela sessão atual:
        $idResp = $_SESSION['infosusuario']['idUsuario'];
            // Verificar se o campo de foto foi preenchido:
            if($_FILES['foto']['size'] != 0){
                // Upload de Arquivos:
                // Valor aleatório: rand(inicial,final);
                // 20211214160617_XXXX
                $novoNome = date('YmdHis')."_".rand(1000,9999);
                // Extrair a extensão do arquivo enviado:
                $ext = substr($_FILES['foto']['name'],-4);
                // Definir o novo nome do arquivo com a extensão:
                $novoNome = $novoNome . $ext;

                // Mover e verificar se deu certo:
                if(move_uploaded_file($_FILES['foto']['tmp_name'], "fotos/".$novoNome)){
                    $foto = "fotos/".$novoNome;
                }else{
                    $foto = "fotos/semfoto.jpg";
                }
                // Caso a foto não esteja definida, setar para fotos/semfoto.jpg
                $sql = "UPDATE produtos SET codbarras = ?, nome = ?, preco = ?, estoque = ?, idCategoria = ?, foto = ? WHERE codbarras = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($codbarras, $nome, $preco, $estoque, $idCategoria, $foto, $idproduto));
                Banco::desconectar();
            }else{
                $sql = "UPDATE produtos SET codbarras = ?, nome = ?, preco = ?, estoque = ?, idCategoria = ? WHERE codbarras = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($codbarras, $nome, $preco, $estoque, $idCategoria, $idproduto));
                Banco::desconectar();
            }
            // Devolver o usuário para tela de administração:
            header("Location: index.php?msg=2");
    }
?>

