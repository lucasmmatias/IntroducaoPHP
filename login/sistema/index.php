<?php
// Array de mensagens:
$mensagens = ["Item apagado com sucesso!",
                "Item cadastrado com sucesso!",
                "Item editado com sucesso!"];


session_start();
// Verificar se a pessoa não possui a sessão:
if(!isset($_SESSION['infosusuario'])){
    // Redirecionar de volta à tela de login:
    header('Location: ../index.php');
}

// Importar o banco.php
require '../db/banco.php';

//Conectar com o banco:
$pdo = Banco::conectar();
// String com a query do banco:
$comandoSql = 'SELECT * FROM viewprodutos WHERE idRespCadastro = ? ORDER BY dataCadastro DESC';
// Atribuição do resultado da consulta no array $resultadoConsulta:
//$resultadoConsulta = $pdo->query($comandoSql)->fetchAll(PDO::FETCH_ASSOC);
$q = $pdo->prepare($comandoSql);
$q->execute(array($_SESSION['infosusuario']['idUsuario']));
// Resultado do BD:
$resultadoConsulta = $q->fetchAll(PDO::FETCH_ASSOC);

// Comandos para puxar as categorias:
$comandoSql = 'SELECT * FROM categorias ORDER BY nome';
$resultadoCategorias = $pdo->query($comandoSql)->fetchAll(PDO::FETCH_ASSOC);
//print_r($resultadoCategorias);

Banco::desconectar();



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
    <title>Painel Administrativo</title>
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
                <div class="display-4">Bem-vindo(a) <?=$_SESSION['infosusuario']['nomeCompleto']; ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
            <?php
            // Verificar se o msg está vindo pelo get:
                if(isset($_GET['msg'])){
                    // Mostrar a mensagem de acordo com o índice do array:
                    echo '<div class="alert alert-success" role="alert">
                    '.$mensagens[$_GET['msg']].'
                  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>';
                }
            ?>
            </div>
            <div class="col-4">
            <button type="button" data-toggle="modal" data-target="#modalCadastro" class="btn btn-success btn-lg btn-block">Cadastrar Produto</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <!-- Tabela de Dados -->
            <table class="table my-4">
                <!-- Cabeçalho da Tabela -->
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código de Barras</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Estoque</th>
                         <th scope="col">Categoria</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <!-- Corpo (Conteúdo) da Tabela -->
                <tbody>
                  <?php
                    foreach($resultadoConsulta as $linha){
                        echo '<tr>';
                        echo '<td>'.$linha['codbarras'].'</td>';
                        echo '<td><img class="imagem" src="'.$linha['foto'].'"/></td>';
                        echo '<td>'.$linha['nome'].'</td>';
                        echo '<td>'.$linha['preco'].'</td>';
                        echo '<td>'.$linha['estoque'].'</td>';
                        echo '<td>'.$linha['nomeCategoria'].'</td>';
                        echo '<td><a href="apagar.php?id='.$linha['codbarras'].'">APAGAR</a> | <a href="editar.php?id='.$linha['codbarras'].'">EDITAR</a></td>';
                        echo '</tr>';
                    }

                ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" method="POST" action="cadastraProduto.php">
        <div class="form-group">
            <label for="codBarras">Código de Barras:</label>
            <input type="text" name="codBarras" class="form-control" id="codBarras" placeholder="00000" maxlength="5">
        </div>
        <div class="form-group">
            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" class="form-control" id="nome" placeholder="Desinfetante Mr Músculos 5L">
        </div>        
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="number" step="0.01" name="preco" class="form-control" id="preco" placeholder="5.99">
        </div>
        <div class="form-group">
            <label for="qtdEstoque">Qtd. Estoque:</label>
            <input type="number" name="qtdEstoque" class="form-control" id="qtdEstoque" placeholder="55">
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select class="form-control" name="categoria" id="categoria">
                <?php
                foreach($resultadoCategorias as $opcao){
                    echo "<option value='".$opcao['id']."'>".$opcao['nome']."</option>";
                }

                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="foto">Foto do Produto:</label>
            <input type="file" name="foto" class="form-control-file" id="foto">
        </div>
        
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">CADASTRAR</button>  
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </form>  
    </div>
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