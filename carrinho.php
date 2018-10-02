<?php 
session_start();
require 'init.php';
header("Content-type:text/html; charset=utf-8");

if(!isset($_SESSION['itens'])){
	$_SESSION['itens'] = array();
}

if(isset($_GET['add']) && $_GET['add'] == "carrinho"){
	
	/* Adiciona ao carrinho */
	$id_produto = $_GET['id'];
	if(!isset($_SESSION['itens'][$id_produto])){
		$_SESSION['itens'][$id_produto] = 1;
	}else{
		$_SESSION['itens'][$id_produto] = 1;
	}
}
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
                    <li class="navbar_direita"><a href="carrinho.php"><img src="img/sacola.png" height="22px"></a></li>
                <?php else: ?>
                    <li><a href="panel.php">Painel</a></li>
                    <li><a href="panel_loja.php">Loja</a></li>
                    <li><a href="logout.php">Sair</a></li>    
                <?php endif; ?>
            <?php else: ?>
                <li><a href="form-login.php">Login</a></li>
                <li><a href="form-add.php">Cadastrar</a></li>    
            <?php endif; ?>        
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
		            <br><h5>Sacola de compras</h5>
		            <hr>
		            <?php
                    $result = 0;
		            /* Exibe o carrinho */
					if(count($_SESSION['itens']) == 0){
						echo "<center><h4 style='color: #FF0000;'>Carrinho vazio!</h4><br><a href='panel_loja.php'>Adicionar itens</a></center>";
					}else{
						$PDO = db_connect();
						foreach ($_SESSION['itens'] as $id_produto => $quantidade) {
							$sql = "SELECT * FROM produtos WHERE id_produto = ?";
							$stmt = $PDO->prepare($sql);
							$stmt->bindParam('1',$id_produto);
							$stmt->execute();
							$produtos = $stmt->fetchAll();
							$total = $quantidade * $produtos[0]['preco_produto'];
							echo 
								"<div class='col-md-12 divest'>
                                    <div class='row'>
                                    <div class='col-md-2
                                    '>
                                <img src='img/camisa.png' width='150px' height='150px'></div><div class='col-md-6'><h6>".$produtos[0]['nome_produto']."</h6>
								<h6>Preço: ".number_format($produtos[0]['preco_produto'],2,",",".")."</h6>
								
								<h6>Quantidade: ".$quantidade."</h6>

								<h6>Total: ".number_format($total,2,",",".")."</h6>
								<div class='col-md-3'>
									<a style='text-decoration: none;' href='remover_carrinho.php?remover=carrinho&id=".$id_produto."'><input type='button' class='btn btn-block btn-danger' value='Remover'></a></div></div></div><hr></div>"
					   		;
						        $result += $total;    
                        }
					}
		            ?>
		            <div class="col-md-6">
                        <form>
                            <input type="submit" name="finalizar_compra" class="btn btn-block btn-success" value="Finalizar Compra">
                        </form>    
		            </div>	
                </div>  
            </div>
        </div>    
    </body>
</html>