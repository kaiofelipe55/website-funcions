<?php 
session_start();

require 'init.php';
header("Content-type:text/html; charset=utf-8");

$id_produto = isset($_GET['product']) ? (int) $_GET['product'] : null;

$pdo = db_connect();
$sql = "SELECT * FROM produtos WHERE id_produto = $id_produto";
$stmt = $pdo->prepare($sql);

if($stmt->execute()){
	if($stmt->rowCount() == 0){
		echo "<center><h4 style='color: #FF0000;'>Você não tem nenhum produto cadastrado!</h4></center>";
        echo "<center><a href='panel_loja.php' style='text-decoration: none;'>Adicionar Produto</a></center>";
	}else{
		$dados = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$nome_produto = $dados['nome_produto'];
		$quantidade_produto = $dados['quantidade_produto'];
		$preco_produto = $dados['preco_produto'];
		$descricao_produto = $dados['descricao_produto'];
	}
}
$porcentagem = $preco_produto / 100;
$resultado = $porcentagem * 40;

$preco_sem_desconto = $preco_produto + $resultado;
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
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <br><br><br><br>  
                            <div>
                			<img src="img/camisa.png" width="400px">
                		  </div>
                	   </div>
                       <div class="col-md-6">
                            <h4 style="padding-top: 100px;"><?php echo $nome_produto; ?></h4>
                            <h6 style="opacity: 0.6;"><?php echo $descricao_produto?></h6>
                            <h6 style="font-size: 17px;">de <?php echo "<strike><a style='font-size: 17px; opacity: 0.4;'> R$ ".number_format($preco_sem_desconto,2)."</a></strike>"; ?></h6>
                            <h6>por <?php echo "<a style='font-size: 30px;'> R$ ".number_format($preco_produto,2)."</a>"; ?></h6>
                            <br>    
                            <hr>
                            <br>
                            <?php echo "<a href='carrinho.php?add=carrinho&id=".$id_produto."' style='text-decoration: none;'><input class='btn btn-block btn-danger' value='Adicionar ao carrinho' type='submit' name='btn-carrinho'></a>";
                            ?>
                       </div>
                    </div>
                </div>
            </div>
        </div>    
    </body>
</html>