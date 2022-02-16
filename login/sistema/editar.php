<?php
// Iniciar sessão:
session_start();
if(!isset($_SESSION['infosusuario'])){
    header('Location: ../index.php?msg=2');
}
// Importar o bd.php:
require '../db/banco.php';
// Conectar com o BD:
$pdo = Banco::conectar();
//Listar categorias:
$consultaCategorias = 'SELECT * FROM categorias ORDER BY nome';
$categoriasBD = $pdo->query($consultaCategorias)->fetchAll();

$consultaProduto = 'SELECT * FROM produtos WHERE codbarras = ?';
$q = $pdo->prepare($consultaProduto);
$q->execute(array($_GET['id']));
// Resultado do BD:
$infosProduto = $q->fetch(PDO::FETCH_ASSOC);
// Desconectar do BD:
Banco::desconectar();

//print_r($infosProduto);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .imagem{
            width: 100px;
        }
    </style>
    <title>Painel Administrativo :: Editar</title>
  </head>
  <body>
    <div class="container-fluid">
        <nav class="navbar navbar-dark bg-primary">
            <span class="navbar-brand mb-0 h1">Painel Administrativo</span>
            <span class="navbar-text">
                <a href="sair.php">Sair</a>
            </span>
        </nav>
        <div class="row">
            <div class="col my-3 mx-4">
                <div class="display-4 text-center">Editar Produto</div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-6">
                <!-- 
                Utilizando o comando SELECT, preencha os 'values' dos inputs abaixo com
                os dados provindos do banco de dados: 
                -->
            <form enctype="multipart/form-data" method="POST" action="modificaProduto.php">
                <div class="form-group">
                    <label for="codBarras">Código de Barras:</label>
                    <input type="text" name="codBarras" value="<?=$infosProduto['codbarras'] ?>" class="form-control" id="codBarras" placeholder="0000000000000" maxlength="13">
                </div>
                <div class="form-group">
                    <label for="nome">Nome do Produto:</label>
                    <input type="text" name="nome" value="<?=$infosProduto['nome'] ?>" class="form-control" id="nome" placeholder="Desinfetante Mr Músculos 5L">
                </div>        
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input type="number" step="0.01" value="" name="preco" class="form-control" id="preco" placeholder="5.99">
                </div>
                <div class="form-group">
                    <label for="qtdEstoque">Qtd. Estoque:</label>
                    <input type="number" name="qtdEstoque" value="" class="form-control" id="qtdEstoque" placeholder="55">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <select class="form-control" name="categoria" id="categoria">
                            <?php
                                foreach($categoriasBD as $categoria){
                                    echo '<option value="'.$categoria['id'].'">'.$categoria['nome'].'</option>';
                                }

                            ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="foto">Foto do Produto:</label>
                    <input type="file" name="foto" class="form-control-file" id="foto">
                </div>
                <!-- 
                    Este input "hidden" deverá possuir o id do produto editado no 
                parâmetro value. Dessa forma será possível passá-lo por POST. 
                -->
                <input type="hidden" id="idProduto" name="idProduto" value="<?=$infosProduto['codbarras'] ?>">

            <button type="submit" class="btn btn-success btn-lg btn-block">EDITAR</button>  
      </form>  
            </div>
            <div class="col-3">

            </div>
        </div>
    </div>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>