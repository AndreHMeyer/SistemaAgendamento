<?php
session_start();
session_destroy();
header('Location: index-teste.php');
exit();