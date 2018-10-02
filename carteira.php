<?php 
session_start();
require 'init.php';
header("Content-type:text/html; charset=utf-8");

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistema de Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        </head>
    <body>
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <?php if (isLoggedIn()): ?>
                <?php if($_SESSION['user_admin'] == '1'): ?>
                    <li><a href="cadastrados.php">Cadastrados</a></li>
                    <li><a href="panel.php">Painel</a></li>
                    <li><a href="panel_loja.php">Loja</a></li>
                    <li><a href="form-produto.php">Cadastro de produtos</a></li>
                    <li><a href="gerar_codigo.php">Gerar Código</a></li>
                    <li><a href="logout.php">Sair</a></li>
                    <li class="navbar_direita"><img height="52px" src="img/user_default.png"></li>
                    <li class="navbar_direita"><a href=""><?php echo $_SESSION['user_nome']; ?></a></li>
                    <li class="navbar_direita"><a href="carteira.php"><?php carteira(); ?></a></li>
                <?php else: ?>
                    <li><a href="panel.php">Painel</a></li>
                    <li><a href="panel_loja.php">Loja</a></li>
                    <li><a href="logout.php">Sair</a></li>
                    <li class="navbar_direita"><img height="52px" src="img/user_default.png"></li>
                    <li class="navbar_direita"><a href=""><?php echo $_SESSION['user_nome']; ?></a></li>
                    <li class="navbar_direita"><a href="carteira.php"><?php echo "R$".$_SESSION['carteira'].".00"; ?></a></li>  
                <?php endif; ?>
            <?php else: ?>
                <li><a href="form-login.php">Login</a></li>
                <li><a href="form-add.php">Cadastrar</a></li>    
            <?php endif; ?>        
        </ul>
        <h1 class="text-center">Sistema de Login</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form action="verifica_codigo.php" method="post" class="form-group">
                        <br>
                        <label>Código:</label>
                        <input type="text" name="codigo" class="form-control">
                        <br>
                        <input type="submit" name="verificar" class="btn btn-block btn-danger" value="Verificar">
                    </form>       
                </div>  
                <div class="col-md-4"></div>
            </div>
        </div>    
    </body>
</html>