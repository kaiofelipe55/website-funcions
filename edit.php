<?php
session_start(); 
require_once 'init.php';
 
// resgata os valores do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$admin = isset($_POST['admin']) ? $_POST['admin'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
 
// validação (bem simples, mais uma vez)
if (empty($nome) || empty($email) || empty($admin))
{
	$_SESSION['msg'] = "<center><h5 style='color: #FF0000;'>Volte e preencha todos os campos</h5></center>";
    header("location:form-edit.php");
    exit;
}
  
// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE usuarios SET nome = :nome, email = :email, admin = :admin WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':admin', $admin);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
 
if ($stmt->execute())
{
    header('Location: cadastrados.php');
}
else
{
    $_SESSION['msg'] = "<center><h5 style='color: #FF0000;'>Erro ao alterar</h5></center>";
    header('Location: cadastrados.php');
    print_r($stmt->errorInfo());
}