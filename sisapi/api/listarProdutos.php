<?php
session_start();
require 'db/banco.php';

//Conectar com o banco:
$pdo = Banco::conectar();
// String com a query do banco:
$comandoSql = 'SELECT * FROM viewprodutos ORDER BY dataCadastro DESC';
$q = $pdo->prepare($comandoSql);
$q->execute();
// Resultado do BD:
$resultadoConsulta = $q->fetchAll(PDO::FETCH_ASSOC);


// Especificar o código HTTP:
header('Content-Type: application/json; charset=utf-8');
http_response_code(200);
echo json_encode($resultadoConsulta);


// // Comandos para puxar as categorias:
// $comandoSql = 'SELECT * FROM categorias ORDER BY nome';
// $resultadoCategorias = $pdo->query($comandoSql)->fetchAll(PDO::FETCH_ASSOC);
// //print_r($resultadoCategorias);

Banco::desconectar();

?>