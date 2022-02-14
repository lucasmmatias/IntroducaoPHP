<?php
session_start();
// Verificar se a pessoa não possui a sessão:
if(!isset($_SESSION['infosusuario'])){
    // Redirecionar de volta à tela de login:
    header('Location: ../index.php');
}

//echo "Olá ".$_SESSION['infosusuario']['nomeCompleto'];
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
                  <!-- Aqui colocaremos os TDs com os dados vindos do BD -->
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
            <input type="text" name="codBarras" class="form-control" id="codBarras" placeholder="0000000000000" maxlength="13">
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