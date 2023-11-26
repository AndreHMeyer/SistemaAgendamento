<?php

header('Content-Type: application/json');

$campoPesquisa = isset($_REQUEST['campo_pesquisa']) ? $_REQUEST['campo_pesquisa'] : "";

$usuario[1] = array(
    'nome' => 'Rúbia'
);

echo json_encode($usuario);
