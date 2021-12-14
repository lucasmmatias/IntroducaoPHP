<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css"/>
    <title>Senaquinho - Contato</title>
</head>

<body>
    <!-- Menu principal -->
    <nav class="navbar navbar-expand-lg bg-pink navbar-dark">
        <div class="container"> <button class="navbar-toggler navbar-toggler-right border-0 p-0" type="button" data-toggle="collapse" data-target="#navbar14">
        <p class="navbar-brand mb-0 text-white">
          <i class="fa d-inline fa-lg fa-stop-circle"></i> Senaquinho </p>
      </button>
            <div class="collapse navbar-collapse" id="navbar14">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"> <a class="nav-link" href="#">Home</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#">Produtos</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#">Contato</a> </li>
                </ul>
                <p class="d-none d-md-block lead mb-0  text-white"> <i class="fa d-inline fa-lg fa-stop-circle"></i>&nbsp;Senaquinho&nbsp;</p>
                <!-- Icones sociais do menu -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">
                            <i class="fa fa-github fa-fw fa-lg"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">
                            <i class="fa fa-gitlab fa-fw fa-lg"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link" href="#">
                            <i class="fa fa-bitbucket fa-fw fa-lg"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="py-5 text-center">
        <!-- Container principal -->
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-6 col-10">
                    <!-- Mensagem do cabeçalho -->
                    <h1>Registrar</h1>
                    <p class="mb-3">Para fazer parte do nosso time, primeiramente precisamos de suas informações :)
                        <?php //echo "<br>".$msgerro; ?>
                        <?php
                        // Verificar se existe o item "erro" definido na URL:
                        if(isset($_GET['erro'])){
                            if($_GET['erro']==1){
                                echo "<br>Você tem um erro.";
                            }
                        }
                        

                        ?>
                    </p>
                    <!-- Formulário -->
                    <form class="text-left" action="enviar.php" method="POST">
                        <div class="form-group">
                            <label for="nome">Nome Completo:</label>
                            <input name="nome" type="text" class="form-control" id="nome" placeholder="Dino da Silva Sauro">
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço:</label>
                            <input name="endereco" type="text" class="form-control" id="endereco" placeholder="Rua Suiça, 1255 - Pindamonhangaba">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label> 
                            <input name="email" type="email" class="form-control" id="email" placeholder="dino.dssauro@sp.senac.br">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="senha1">Senha:</label>
                                <input name="senha" type="password" class="form-control" id="senha1" placeholder="••••">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="senha2">Confirme sua senha:</label>
                                <input name="csenha" type="password" class="form-control" id="senha2" placeholder="••••">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="form21" value="on">
                                <label class="form-check-label" for="form21"> 
                                Li, e estou de acordo com os <a href="#" data-toggle="modal" data-target="#modalTermos">Termos e Condições</a> de serviço. </label>
                            </div>
                        </div>
                        <button type="submit" data-toggle="modal" class="btn btn-pink btn-lg btn-block"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center d-md-flex align-items-center">
                    <ul class="nav d-flex justify-content-center">
                        <li class="nav-item"> <a class="nav-link active" href="#">Home</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="#">Início</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="#">Contatp</a> </li>
                    </ul> <i class="d-block fa fa-stop-circle fa-3x mx-auto text-pink"></i>
                    <p class="mb-0 py-1">©2029 Senaquinho. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>