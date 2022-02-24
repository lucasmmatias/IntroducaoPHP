<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
require 'db/banco.php';



// Array de Status:
$status = ["status" => 0, "mensagem" => "0", "dados" => 0];

if (!isset($_SESSION['infosusuario'])) {
    http_response_code(200);
    header('Content-Type: application/json; charset=utf-8');
    $status["mensagem"] = "Acesso permitido apenas para usuários autenticados.";
    echo json_encode($status);
} else {
    //Conectar com o banco:
    $pdo = Banco::conectar();
    // String com a query do banco:
    $comandoSql = 'SELECT * FROM viewprodutos WHERE idRespCadastro = ? ORDER BY dataCadastro DESC';
    $q = $pdo->prepare($comandoSql);
    $q->execute(array($_SESSION['infosusuario']['idUsuario']));
    // Resultado do BD:
    $resultadoConsulta = $q->fetchAll(PDO::FETCH_ASSOC);


    // Especificar o código HTTP:
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(200);
    $status["status"] = 1;
    $status["mensagem"] = "Sucesso!";
    $status["dados"] = $resultadoConsulta;
    echo json_encode($status);


    // // Comandos para puxar as categorias:
    // $comandoSql = 'SELECT * FROM categorias ORDER BY nome';
    // $resultadoCategorias = $pdo->query($comandoSql)->fetchAll(PDO::FETCH_ASSOC);
    // //print_r($resultadoCategorias);

    Banco::desconectar();
}
