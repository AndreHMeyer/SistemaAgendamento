<?php
session_start();
include('..\bancoDeDados\conexao.php');

if(empty($_POST['email']) || empty($_POST['senha'])) {
	header('Location: index-teste.php');
	exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select nomeUsuario from usuario where email = '{$email}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
	$usuario_bd = mysqli_fetch_assoc($result);
	$_SESSION['email'] = $usuario_bd['email'];
	header('Location: painel.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index-teste.php');
	exit();
}