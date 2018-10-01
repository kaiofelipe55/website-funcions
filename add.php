<?php 
session_start();
require_once 'init.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$senha = isset($_POST['senha']) ? MD5(SHA1($_POST['senha'])) : null;

if(trim($nome)=='' || trim($email)=='' || trim($senha)==''){
	$_SESSION['msg'] = "<center><h5 style='color: #FF0000;'>Preencha todos os campos</h5></center>";
	header("location:form-add.php");
}
$PDO = db_connect();
$sql = "INSERT INTO usuarios(nome, email, senha, admin) VALUES(:nome, :email, :senha, '0')";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);

if($stmt->execute()){
	header("location:cadastrados.php");
}else{
    $_SESSION['msg'] = "<center><h5 style='color: #FF0000;'>Erro ao cadastrar</h5></center>";
    print_r($stmt->errorInfo());
}
?>