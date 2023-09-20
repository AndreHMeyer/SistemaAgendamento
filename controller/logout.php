<?php
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['email'])) {
    session_unset();
    session_destroy();
}

// Evite o armazenamento em cache da página
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Redireciona o usuário para a página de login
header('Location: index.html');
exit();
?>
