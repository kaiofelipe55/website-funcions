<?php 
session_start();
require 'init.php';
header("Content-type:text/html; charset=utf-8");

$valor = isset($_POST['valor']) ? (double) $_POST['valor'] : '';
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';

if(trim($valor)=='' || trim($codigo)==''){
	$_SESSION['msg'] = "<center><h4 style='color: #FF0000;'>Preencha todos os campos!</h4></center>";
    header("location:gerar_codigo.php");
}

$PDO = db_connect();
$sql = "INSERT INTO codigo (codigo, valor) VALUES (:codigo, :valor)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codigo', $codigo);
$stmt->bindParam(':valor', $valor);

if($stmt->execute()){
	$_SESSION['msg'] = "<center><h5 style='color: #00FF00;'>Código criado com sucesso!</h5></center>";
	header("location:gerar_codigo.php");
}else{
	$_SESSION['msg'] = "<center><h5 style='color: #FF0000;'>Falha ao cadastrar!</h5></center>";
	header("location:gerar_codigo.php");
}
?>