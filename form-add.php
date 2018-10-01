<?php 
session_start();

require 'init.php';
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
        </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <br><h1 class="text-center">Login</h1>
                        <br>
                        <?php
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                        ?>
                        <div class="jumbotron">
                            <form action="add.php" method="post">
                                <label>Nome: </label>
                                <br>
                                <input class="form-control" type="text" name="nome">
                                <br>
                                <label for="email">Email: </label>
                                <br>
                                <input class="form-control" type="text" name="email" id="email">
                                <br>
                                <label for="password">Senha: </label>
                                <br>
                                <input class="form-control" type="password" name="senha" id="password">
                                <br>
                                <input type="submit" class="btn btn-block btn-success" value="Cadastrar">
                            </form>
                        </div>    
                </div>  
                <div class="col-md-4"></div>
            </div>
        </div>    
    </body>
</html>