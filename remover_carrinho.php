<?php 
session_start();

if(isset($_GET['remover']) && $_GET['remover'] == "carrinho"){
	$id_produto = $_GET['id'];
	unset($_SESSION['itens'][$id_produto]);
	header("location:carrinho.php");
}
?>