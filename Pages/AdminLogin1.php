

<?php

$user="root";
$pass="alam";
$database="GIT_SE";


$conn= mysqli_connect('localhost',$user,$pass,$database);
$count=0;
$msg="";
$id="";
$pas="";



 if(isset($_POST['submit'])) { 
session_start();
$id=$_POST['username'];
$pas=$_POST['password']; 
if(!empty($_POST['username'])) 
{ 
$query = "SELECT * FROM Admin_Info where Admin_ID = '$id' AND Password = '$pas' limit 1";
$result=$conn->query($query) ;

if($result->num_rows==1)
{ 
$_SESSION['Admin_ID'] = $_POST['username']; 
header("Location:Admin.php");; 
} 
else 
{ 
echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY..."; }
}
 } 
 

?>


<!DOCTYPE html>

<html>
<head>
    <title>Admin</title>
    <link href="../Style Sheets/Home.css" type="text/css" rel="stylesheet" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../Bootstrap/css/bootstrap.css" rel="stylesheet" />
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.js"></script>
    <script src="../Bootstrap/js/npm.js"></script>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

<?php
$id="";
echo $msg;
?>

<form action="AdminLogin.php" method="post">
	Username:<input type="text" name="username" value="<?php echo $id;?>"/><br/>
	Password:<input type="password" name="password" value=""/>
	<br/>
	<input type="submit" name="submit" value="Submit"/>
	</form>


</body>
</html>
<?php
mysqli_close($conn);
?>