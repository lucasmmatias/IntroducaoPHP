<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
<br>
<a href="produto1.php">Pop Funko Cartman</a><br>
<a href="produto2.php">Desodorante Above</a><br>
<a href="produto3.php">Alcool Gel Qatar</a><br>
    <h1>Último produto visualizado:</h1>
    <br>
    <?php
        echo $_COOKIE["produto"];
    ?>
    <br>
</body>
</html>