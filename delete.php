<?php
 
require_once 'init.php';
 
// pega o ID da URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
 
// valida o ID
if (empty($id))
{
    $_SESSION['msg'] = "<center><h5 style='color: #FF0000;'>ID não informado</h5></center>";
    header("location:cadastrados.php");
    exit;
}
 
// remove do banco
$PDO = db_connect();
$sql = "DELETE FROM usuarios WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
 
if ($stmt->execute())
{
    header('Location: cadastrados.php');
}
else
{
    $_SESSION['msg'] = "<center><h5 style='color: #FF0000;'>Erro ao remover</h5></center>";
    header("location:cadastrados.php");
    print_r($stmt->errorInfo());
}