<?php 

    try {
        $pdo = new PDO("mysql:dbname=projeto_caixa_eletronico;host=localhost", "root", "");
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }

?>