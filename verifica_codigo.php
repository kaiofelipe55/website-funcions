<?php 
session_start();
require 'init.php';
header("Content-type:text/html; charset=utf-8");

$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';

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
$user = $users[0];

$_SESSION['carteira'] += $user['valor'];

$sql_ = "DELETE FROM codigo WHERE codigo = :codigo";
$stmt_ = $PDO->prepare($sql_);
$stmt_->bindParam(':codigo',$codigo);
$stmt_->execute();

header('Location:index.php');
}
?>