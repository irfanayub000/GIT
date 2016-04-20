
<?php
Session_Start();
$user="root";
$pass="alam";
$database="GIT_SE";
$conn= mysqli_connect('localhost',$user,$pass,$database);

if(isset($_GET['act'])){
	if($_GET['act']=="Enroll"){
		$theUser=$_SESSION['User_ID'];
		$query="select * from GIT_User where GIT_UserID='$theUser' limit 1";
						$result=mysqli_query($conn,$query);
						$idCount=0;
	$query1="SELECT MAX(GIT_UserID) AS High FROM GIT_User";
	$resultt=mysqli_query($conn,$query1);
	foreach($resultt as $ress){
		$idCount=$ress['High'];
	}

	$idCount++;

foreach($result as $res){
	         
		
			$theReq=$_GET['cid'];		
			$theName=$res['Name'];
            $theEmail=$res['Email'];
			$theAge=$res['Age'];
			$thePhone=$res['Phone'];
			$theCnic=$res['CNIC'];
			$theAddr=$res['Address'];
			$theGender=$res['Gender'];
			$thePass=$res['User_Password'];
			
		    }
		$queryy="INSERT INTO GIT_User_Request (Temp_ID, Name, User_Password,Request_For, Email,Age, Gender,Address,Phone,CNIC,Active) VALUES('$idCount', '$theName','$thePass',  '$theReq','$theEmail', '$theAge','$theGender','$theAddr','$thePhone','$theCnic','$theUser')";
        
			mysqli_query($conn,$queryy);
	}
	
	
}

$nameError = "";
$emailError = "";
$passError = "";
$addrError = "";
$ageError = "";
$phoneError = "";
$cnicError = "";
$genderError = "";
$gender = "";

if($_POST["submit"])
{

if (empty($_POST["name"])) {
	$nameError = "Only letters and white space allowed in Name";
}

else {
$name = test_input($_POST["name"]);

if(!preg_match("/^[a-zA-Z ]*$/" , $name)){
	
	$nameError = "Only Letters and white spaces allowed";
	
	}
}

if(empty($_POST["email"])) {

	$emailError = "Email is required";
}

else {

	$email = test_input($_POST["email"]);
	// check if e-mail address syntax is valid or not
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		
		$emailError = "Invalid email format";
	}
}

if(empty($_POST["password"]))
{
	$passError = "Password Required";
}
else{
	$password = $_POST["password"];
}

if (empty($_POST["address"])) {

	$addrError = "Address Is Required";
}
else {
	$address = $_POST["address"];
}

if (empty($_POST["gender"])) {

	$genderError = "Gender is required";
}

else{

	$gender = $_POST["gender"];
	echo $gender;
}

if (empty($_POST["age"])) {

	$ageError = "Age Is required";
}

else{
	
	$age = $_POST["age"];

	if(!is_int($age)){
		$ageError = "Age Must be in Numbers";
	}
}


if(empty($_POST["phone"])){

	$phoneError = "Phone Number Is Required";
}

else{

	$phone = $_POST["phone"];

	if(!preg_match('/^[0-9]{4}-[0-9]{11}$/', $_POST['phone']))
    {
    	$phoneError = 'Invalid Phone Number! use format 0300-1234567';
    }
}


if(empty($_POST["cnic"])){

	$cnicError = "CNIC number Is Required";
}


else{

	$cnic = $_POST["cnic"];
	if(!preg_match('/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/', $_POST['phone']))
    {
    	$cnicError = 'Invalid CNIC Number!';
    }
}
	

	$idCount=0;
	$query1 = 'SELECT MAX(GIT_UserID) AS High FROM GIT_User';
	$result = mysqli_query($conn,$query1);

	foreach($result as $res){
		$idCount=$res['High'];
	}
	$idCount++;
	
	$query="INSERT INTO GIT_User_Request (Temp_ID,Name,User_Password,Request_For,Email,Age,Gender,Address,Phone,CNIC,Active) VALUES('$idCount', '".$_POST['name']."','".$_POST['password']."', '".$_GET['cid']."','".$_POST['email']."', '".$_POST['age']."', '".$gender."', '".$_POST['address']."', '".$_POST['phone']."', '".$_POST['cnic']."','No')";										
		mysqli_query($conn,$query);								
										
}


?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Enroll</title>
    <link href="../Style Sheets/home.css" type="text/css" rel="stylesheet" />

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
        <script src="../script/script.js"></script>

</head>


<body>
<div class="form_div">
<form action="Enroll.php" method="post">
<h2>Form</h2>
<span class="error">* required fields!</span>
<br/>
Name:
<input class="input" name="name" type="text" value="">
<span class="error">* <?php echo $nameError;?></span>
<br/>
E-mail:
<input class="input" name="email" type="text" value="">
<span class="error">* <?php echo $emailError;?></span>
<br/>
Password:
<input class="input" name="password" type="text" value="">
<span class="error">* <?php echo $passError;?></span>
<br/>
Gender:
<span class="error">*<?php echo $genderError;?></span>
<input class="radio" name="gender" type="radio" value="female">Female
<input class="radio" name="gender" type="radio" value="male">Male
<br/>
Website:
<input class="input" name="age" type="text" value="">
<span class="error">* <?php echo $ageError;?></span>
<br/>
Address: <br/>
<textarea cols="40" name="address" rows="5">
</textarea>

<br/>
Mobile Number:
<input class="input" name="phone" type="text" value="">
<span class="error">* <?php echo $phoneError;?></span>
<br/>
CNIC Number:
<input class="input" name="cnic" type="text" value="">
<span class="error">* <?php echo $cnicError;?></span>

<br/>

<input class="submit" name="submit" type="submit" value="Submit">
<br/>
</form>
</div>    
</body>
</html>
<?php
mysqli_close($conn);
?>