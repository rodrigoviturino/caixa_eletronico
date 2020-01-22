<?php 
session_start();

// Destruindo a variavel
unset($_SESSION['banco']);
header("Location: index.php");
exit;

?>