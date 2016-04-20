<?php
SESSION_START();
 if(isset($_SESSION['User_ID']))
{
	
		$_SESSION['User_ID']=null;
		$_SESSION['User_Name']=null;
header("Location:Home.php");
	
}

?>