<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Login - Sistema</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }

        .form button:hover,
        .form button:active,
        .form button:focus {
            background: #43A047;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form .register-form {
            display: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }

        .container:before,
        .container:after {
            content: "";
            display: block;
            clear: both;
        }

        .container .info {
            margin: 50px auto;
            text-align: center;
        }

        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }

        .container .info span a {
            color: #000000;
            text-decoration: none;
        }

        .container .info span .fa {
            color: #EF3B3A;
        }

        body {
            background: #76b852;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(right, #76b852, #8DC26F);
            background: -moz-linear-gradient(right, #76b852, #8DC26F);
            background: -o-linear-gradient(right, #76b852, #8DC26F);
            background: linear-gradient(to left, #76b852, #8DC26F);
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .mensagem {
            text-align: center;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-page">
        <div class="form">
            <form class="register-form" id="formCadastro">
                <input type="text" id="cadNome" name="cadNome" placeholder="Nome Completo" />
                <input type="text" id="cadUsername" name="cadUsername" placeholder="Username" />
                <input type="text" id="cadEmail" name="cadEmail" placeholder="E-mail" />
                <input type="password" id="cadSenha1" name="cadSenha1" placeholder="Senha" />
                <input type="password" id="cadSenha2" name="cadSenha2" placeholder="Confirmar Senha" />
                <button onclick="cadastrar()" type="button">Cadastrar</button>
                <p class="message">Já possui conta? <a href="#">Entrar</a></p>
            </form>
            <form class="login-form">
                <input type="text" placeholder="Username" name="username" />
                <input type="password" placeholder="Senha" name="password" />
                <button>entrar</button>
                <p class="message">Ainda não tem conta? <a href="#">Efetuar cadastro.</a></p>
            </form>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.message a').click(function() {
        $('form').animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow");
    });

    // Função para cadastrar o usuário:
    function cadastrar() {
        $.post("api/registrar.php", {
            cadUsername: cadUsername.value,
            cadSenha1: cadSenha1.value,
            cadSenha2: cadSenha2.value,
            cadEmail: cadEmail.value,
            cadNome: cadNome.value
        }).done(function(data) {
            if (data.status == 1) {
                swal("Sucesso!", data.mensagem, 'success');
                // Apagar todos os dados do form
                $('#formCadastro').trigger("reset");
                $('form').animate({
                    height: "toggle",
                    opacity: "toggle"
                }, "slow");
            }
        });
    }
</script>

</html>