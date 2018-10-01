<?php
session_start();

require 'init.php';

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? MD5(SHA1($_POST['password'])) : '';

if(empty($email) || empty($password)){
    $_SESSION['msg'] = "<center><h4 style='color: #FF0000;'>Preencha todos os campos!</h4></center>";
    header("location:form-login.php");
}

$PDO = db_connect();

$sql = "SELECT id, nome, admin FROM usuarios WHERE email = :email AND senha = :password";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':email',$email);
$stmt->bindParam(':password',$password);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($users) <= 0){
    $_SESSION['msg'] = "<center><h4 style='color: #FF0000;'>Email ou senha incorretos</h4></center>";
    header("location:form-login.php");
}else{
$user = $users[0];

$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_nome'] = $user['nome'];
$_SESSION['user_admin'] = $user['admin'];

header('Location:index.php');
}
?>