<?php

require_once ("..\model\usuarios\Login.php");

$login = new Login('joao@teste.com', 'hashed_password1');

$autenticado = $login->autenticar();

if ($autenticado) {
    return 'success';

//    return 'sucesso';
}


