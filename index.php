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
    <hr>

    <h3>Movimentação / Extrato</h3>

    <a href="add-transacao.php">Adicionar Valor</a>

    <table border="1" width="600">
        <thead>
            <tr>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = $pdo->prepare(" SELECT * FROM historico WHERE id_conta = :id_conta");
                $sql->bindValue(":id_conta", $id);
                $sql->execute();

                if($sql->rowCount() > 0 ){
                    $info = $sql->fetchAll();

                    foreach ($info as $item) {
                ?>
                    <tr>
                        <td><?= date('d/m/y H:i', strtotime($item['data_operacao'])); ?></td>
                        <td>
                            <?php if($item['tipo'] == 0 ): ?>
                                <span color="green"> R$: + <?= $item['valor'] ?> </span>
                            <?php else: ?>
                                <span color="red"> R$: - <?= $item['valor'] ?> </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php 
                    }
                }
            ?>
        </tbody>
    </table>


</body>
</html>