<?php
SESSION_START();
if(isset($_SESSION['Admin_ID'])){
	$_SESSION['Admin_ID']=null;
header("Location:AdminLogin.php");
}


?>