<?php  
session_start();
require 'init.php';

$nome_produto = isset($_POST['nome']) ? $_POST['nome'] : null;
$quantidade_produto = isset($_POST['quantidade']) ? $_POST['quantidade'] : null;
$preco_produto = isset($_POST['preco']) ? $_POST['preco'] : null;
$descricao_produto = isset($_POST['descricao']) ? $_POST['descricao'] : null;

if(trim($nome_produto)=='' || trim($quantidade_produto)=='' || trim($preco_produto)=='' || trim($descricao_produto)==''){
	$_SESSION['msg'] = "<center><h5 style='color: #FF0000;'>Preencha todos os campos</h5></center>";
	header("location:form-produto.php");
}

$PDO = db_connect();
$sql = "INSERT INTO produtos (nome_produto, quantidade_produto, preco_produto, descricao_produto) VALUES (:nome_produto, :quantidade_produto, :preco_produto, :descricao_produto)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome_produto', $nome_produto);
$stmt->bindParam(':quantidade_produto', $quantidade_produto);
$stmt->bindParam(':preco_produto', $preco_produto);
$stmt->bindParam(':descricao_produto', $descricao_produto);

if($stmt->execute()){
	$_SESSION['msg'] = "<center><h5 style='color: #00FF00;'>Produto cadastrado com sucesso</h5></center>";
	header("location:form-produto.php");
}else{
	$_SESSION['msg'] = "<center><h5 style='color: #FF0000;'>Erro ao cadastrar</h5></center>";
	header("location:form-produto.php");
    print_r($stmt->errorInfo());
}
?>