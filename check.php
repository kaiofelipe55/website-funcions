<?php
require_once 'init.php';

if(!isLoggedIn()){
	header("location:form-login.php");
}

?>