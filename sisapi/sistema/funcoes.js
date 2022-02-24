function confirma(codbarras, nome) {
    // if(confirm("Deseja realmente apagar o produto "+nome+"?")){
    //     // Redirecionar para a apagar.php:
    //     location.href = "apagar.php?id="+codbarras;
    // }
    swal({
            title: "Atenção!",
            text: "Tem certeza que deseja remover " + nome + " da lista de produtos?",
            icon: "warning",
            buttons: ["NÃO", "REMOVER"],
            dangerMode: true,
        })
        .then((resposta) => {
            if (resposta) {
                location.href = "apagar.php?id=" + codbarras;
            } else {
                swal("Seu produto está a salvo!");
            }
        });
}


// Carregamento de informações quando a página terminar de carregar:
$(document).ready(function() {
    // Puxar o nome do usuário pela API:
    $.getJSON("../api/dadosUsuario.php").done(function(data) {
        $("#nomeCompleto").text(data.dados.nomeCompleto);
    });
    $.getJSON("../api/listarProdutos.php").done(function(data) {
        if (data.status == 0) {
            // Caso o usuário não esteja logado:
            swal({
                    title: "Atenção!",
                    text: "Você precisa logar primeiro!",
                    icon: "warning",
                    //buttons: true
                })
                .then((resposta) => {
                    location.href = "../index.php";
                });
        } else {
            // Listar os produtos caso o usuário esteja logado:
            data.dados.forEach(function(produto) {
                $("#corpoTabela").append("<tr>");
                $("#corpoTabela").append("<td>" + produto.codbarras + "</td>");
                $("#corpoTabela").append("<td><img class='imagem' src='" + produto.foto + "' /></td>");
                $("#corpoTabela").append("<td>" + produto.nome + "</td>");
                $("#corpoTabela").append("<td>" + produto.preco + "</td>");
                $("#corpoTabela").append("<td>" + produto.estoque + "</td>");
                $("#corpoTabela").append("<td>" + produto.nomeCategoria + "</td>");
                $("#corpoTabela").append("<td><a href=\"#\" onclick=\"confirma("+produto.codbarras+",'"+produto.nome+"')\">APAGAR</a> | Editar</td>");
                $("#corpoTabela").append("</tr>");
            });
        }
    });
});