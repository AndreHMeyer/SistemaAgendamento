<?php

$user = "root";
$conexao = new PDO("mysql:host=localhost;dbname=sistemaagendamento", $user);


$queryConsultas = "SELECT observacao, data FROM consulta";

$exeConsultas = $conexao->prepare($queryConsultas);
$exeConsultas->execute();
$events = [];
while ($rowConsultas = $exeConsultas->fetch(PDO::FETCH_ASSOC)) {
    // $data = $rowConsultas['data'];
    // $observacao = $rowConsultas['observacao'];
    extract($rowConsultas);
    $events[] = ['title' => $observacao, 'start' => $data];
}
echo json_encode($events);
