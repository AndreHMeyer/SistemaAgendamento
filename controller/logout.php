<?php
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['usuario'])) {
    session_unset();
    session_destroy();
}

// Redireciona o usuário para a página de login
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/SistemaAgendamento/';
header('Location: ' . $base_url . 'index.php');
exit();
?>
