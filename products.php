<?php 
session_start();
require 'init.php';
header("Content-type:text/html; charset=utf-8");

$id_produto = isset($_GET['id_produto']) ? (int) $_GET['id_produto'] : null;

if(trim($id_produto)==''){
	$_SESSION['msg'] = "ID para alteração não definido";
    header("location:index.php");
    exit;
}

$PDO = db_connect();
$sql = "SELECT nome_produto, quantidade_produto, preco_produto, descricao_produto FROM produtos WHERE id_produto = :id_produto";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
 
$stmt->execute();
 
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!is_array($user))
{
    $_SESSION['msg'] = "Nenhum usuário encontrado";
    header("location:index.php");
    exit;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Products</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?php
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                    ?>
                          
                </div>      
                <div class="col-md-2"></div>
            </div>    
        </div>
    </body>
</html>