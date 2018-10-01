<?php 

function productStyle($nome_produto, $quantidade_produto, $preco_produto, $descricao_produto, $id_produto){
	$style = "
	<div class='col-md-3' style='padding-top:3%;'>
    	<br><div class='card' style='width: 16rem;'>
			<img class='card-img-top' src='img/camisa.png' style='width: 250px;' alt='Camisa'>
			<div class='card-body'>
				<center><h5 class='card-title'>".$nome_produto."</h5></center>
				<center><h5 class='card-title' style='color: #828282;'>R$ ".number_format($preco_produto,2)."</h5></center>
				<center><p class='card-text'>".$descricao_produto."</p></center><br>
				<center><a href='panel_produto.php?product=".$id_produto."' class='btn btn-block btn-primary'>Comprar</a></center>
			</div>
		</div>
		</div>
";
    return $style;
}
?>