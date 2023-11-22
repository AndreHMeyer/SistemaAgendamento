<?php

require_once ("..\model\usuarios\Login.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados enviados pelo cliente e decodifica a string JSON em um array associativo
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica se a decodificação do JSON foi bem-sucedida
    if ($data !== null) {
        // Agora você pode acessar os dados enviados pelo cliente
        $email = $data['email'];
        $senha = $data['senha'];

        //Instancia a classe login com o email e senha recebidos e chama o método que faz a autenticação
        $login = new Login($email, $senha);
        $autenticacao = $login->autenticar();

        if ($autenticacao) {
            $result = array("result" => "success");
            session_start();
            $_SESSION['usuario'] = $email;
            header('Content-Type: application/json'); // Retorna a resposta em formato JSON para o cliente
            echo  json_encode($result); //Utiliza echo para retornar valor ao AJAX
        } else {
            $result = array("result" => "failed");
            header('Content-Type: application/json'); // Retorna a resposta em formato JSON para o cliente
            echo  json_encode($result); //Utiliza echo para retornar valor ao AJAX
        }


    } else {
        // Se a decodificação do JSON falhar, retornar um erro
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array("error" => "Falha na decodificação JSON"));
    }
} else {
    // Se a requisição não for POST, retornar um erro
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(array("error" => "Método não permitido"));
}




