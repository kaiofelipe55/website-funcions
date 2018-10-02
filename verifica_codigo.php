<?php 
session_start();
require 'init.php';
header("Content-type:text/html; charset=utf-8");

$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if(trim($codigo)==''){
	$_SESSION['msg'] = "<center><h4 style='color: #FF0000;'>Preencha todos os campos!</h4></center>";
    header("location:carteira.php");
}

$PDO = db_connect();
$sql = "SELECT * FROM codigo WHERE codigo = :codigo";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codigo', $codigo);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($users) <= 0){
    $_SESSION['msg'] = "<center><h4 style='color: #FF0000;'>Código inválido</h4></center>";
    header("location:carteira.php");
}else{
$result = $users[0];
$carteira += $result['valor'];

$PDO = db_connect();
$sql = "UPDATE usuarios SET carteira = :carteira WHERE id = :user_id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':user_id', $id);
$stmt->bindParam(':carteira', $carteira);
$stmt->execute();	

header('Location:index.php');
}
?>