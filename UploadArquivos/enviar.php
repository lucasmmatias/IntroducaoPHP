<?php
// Definir fuso horário:
date_default_timezone_set('America/Sao_Paulo');

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
    echo "Show!<br>";
    echo "<img src='fotos/{$novoNome}' />";
}
else{
    echo "Não deu certo :(<br>";
}


//print_r($_FILES);





// $senha = $_POST['senha'];
// $csenha = $_POST['csenha'];

// if ($senha == $csenha){
//     echo "Show! Deu certo!";
// }else{
//     // Redirecionar a pessoa, de volta para a contato.php:
//     header("Location: contato.php?erro=1");
// }
?>