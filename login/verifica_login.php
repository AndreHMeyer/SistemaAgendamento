<?php
session_start();
if(!$_SESSION['nome']) {
	header('Location: index-teste.php');
	exit();
}