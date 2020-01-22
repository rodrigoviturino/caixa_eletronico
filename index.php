<?php

session_start();
require_once "config.php";

if(isset($_SESSION['banco']) && !empty($_SESSION['banco']) ) {
    $id = $_SESSION['banco'];
    
    $sql = $pdo->prepare(" SELECT * FROM contas WHERE id = :id ");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0 ){
        $info = $sql->fetch();
    } else {
        header("Location: login.php");
        exit;
    }


} else {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projeto - Caixa Eletronico</title>
</head>
<body>
    <h1>Banco Real</h1>
<p>
    Titular: <?= $info['titular']; ?>
</p>

    <p>
        Agência: <?= $info['agencia']; ?>
    </p>
    <p>
        Conta: <?= $info['conta']; ?>
    </p>
    <p>
        Saldo: <?= $info['saldo']; ?>
    </p>

    <a href="sair.php">Sair</a>
</body>
</html>