<?php
// Definir fuso horário:
date_default_timezone_set('America/Sao_Paulo');

// Upload de Arquivos:

// Valor aleatório: rand(inicial,final);
// 20211214160617_XXXX
$novoNome = date('YmdHis')."_".rand(1000,9999);
echo $novoNome;





// $senha = $_POST['senha'];
// $csenha = $_POST['csenha'];

// if ($senha == $csenha){
//     echo "Show! Deu certo!";
// }else{
//     // Redirecionar a pessoa, de volta para a contato.php:
//     header("Location: contato.php?erro=1");
// }
?>