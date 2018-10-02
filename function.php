<?php

function db_connect(){
	$PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
	return $PDO;
}

function make_hash($str)
{
    return sha1(md5($str));
}

function isLoggedIn(){
	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
		
		return false;
	}

	return true;
}

function carteira(){
	$id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

	$PDO = db_connect();
	$sql = "SELECT carteira FROM usuarios WHERE id = :user_id";
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':user_id', $id);
	$stmt->execute();

	$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$result = $dados[0];

	$carteira = $result['carteira'];

	echo (number_format($carteira,2,",","."));

	$_SESSION['carteira'] = $carteira;
}
?>