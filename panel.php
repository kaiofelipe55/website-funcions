<?php
session_start();
 
require_once 'init.php';

require 'check.php';
header("Content-type:text/html; charset=utf-8");
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Painel | Sistema de Login ULTIMATE PHP</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <div class="container">
        	<div class="row">
        		<div class="col-md-4"></div>
        		<div class="col-md-4">
        			<h1>Painel do Usuário</h1>
 
        			<p>Bem-vindo ao seu painel, <?php echo $_SESSION['user_nome']; ?> | <a href="logout.php">Sair</a></p>
        		</div>
        		<div class="col-md-4"></div>
        	</div>
        </div> 
    </body>
</html>