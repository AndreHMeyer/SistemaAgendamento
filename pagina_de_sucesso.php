<?php
    session_start();

    if(!isset($_SESSION['usuario'])) { 
        header('Location: index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Remember Med</title>
    <link rel="stylesheet" href="includes/bootstrap-4.0.0/bootstrap-4.0.0/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="includes/icons-main/font/bootstrap-icons.css" />
    <script src="includes/jquery-3.7.1.js"></script>
</head>
<style>
    .bg-img{
        width: calc(100vw - 64px);
        height: calc(100vh - 66px);
        margin-left: 64px;
        margin-top: 66px;
    }
</style>
<body>

    <div id="nav-head">
    </div>
    <div id="nav-lateral">
    </div>
    
    <div>
        <img src="img/imagem_login.jpeg" class="bg-img" alt="">
    </div>
    
</body>
<script>
    $(function () {
        $("#nav-head").load("navbar_head.html");
    });
    $(function () {
        $("#nav-lateral").load("navbar_lateral.html");
    });
</script>
</html>