
<?php
Session_Start();
$user="root";
$pass="alam";
$database="GIT_SE";


$conn= mysqli_connect('localhost',$user,$pass,$database);

$Error = "";

if(isset($_GET['act'])){
	if($_GET['act']=="Enroll"){
		$theUser=$_SESSION['User_ID'];
		$query="select * from GIT_User where GIT_UserID='$theUser' limit 1";
					$result=mysqli_query($conn,$query);
				

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
		$queryy="INSERT INTO GIT_User_Request ( Name, User_Password,Request_For, Email,Age, Gender,Address,Phone,CNIC,Active) VALUES( '$theName','$thePass',  '$theReq','$theEmail', '$theAge','$theGender','$theAddr','$thePhone','$theCnic','$theUser')";
        
			mysqli_query($conn,$queryy);
	}
	
	
}




else if(isset($_POST['submit'])){
/*	
if (empty($_POST["name"])) {
	$nameError = "Only letters and white space allowed in Name";
}

else {


if(!preg_match("/^[a-zA-Z ]*$/" , $_POST["name"])){
	
	$Error = $Error ."<br/>Only Letters and white spaces allowed";
	
	}
}

if(empty($_POST["email"])) {

	$Error = $Error ."<br/>Email is required";
}

else {

	$email =$_POST["email"];
	// check if e-mail address syntax is valid or not
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		
		$Error = $Error. "Invalid email format";
	}
}

if(empty($_POST["password"]))
{
	$Error = $Error ."<br/>Password Required";
}
else{
	$password = $_POST["password"];
}

if (empty($_POST["address"])) {

	$Error =$Error . "<br/>Address Is Required";
}
else {
	$address = $_POST["address"];
}

if (empty($_POST["gender"])) {

	$Error = $Error ."Gender is required";
}

else{

	$gender = $_POST["gender"];
	echo $gender;
}

if (empty($_POST["age"])) {

	$Error = $Error ."<br/>Age Is required";
}

else{
	
	$age = $_POST["age"];

	if(!is_int($age)){
		$Error = $Error ."<br/>Age Must be in Numbers";
	}
}


if(empty($_POST["phone"])){

	$Error = "<br/>Phone Number Is Required";
}

else{

	$phone = $_POST["phone"];

	if(!preg_match('/^[0-9]{4}-[0-9]{11}$/', $_POST['phone']))
    {
    	$Error = $Error .'<br/>Invalid Phone Number! use format 0300-1234567';
    }
}


if(empty($_POST["cnic"])){

	$Error = $Error ."<br/>CNIC number Is Required";
}


else{

	$cnic = $_POST["cnic"];
	if(!preg_match('/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/', $_POST['phone']))
    {
    	$Error = $Error .'<br/>Invalid CNIC Number!';
    }
}
	
	
	

	if($Error==""){*/
	$query="INSERT INTO GIT_User_Request (Name,User_Password,Request_For,Email,Age,Gender,Address,Phone,CNIC,Active) VALUES( '".$_POST['name']."','".$_POST['password']."', '".$_GET['cid']."','".$_POST['email']."', '".$_POST['age']."', '".$_POST['gender']."', '".$_POST['address']."', '".$_POST['phone']."', '".$_POST['cnic']."','No')";										
		mysqli_query($conn,$query);								
		//}								
}





 



?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Courses</title>
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
        <script src="../script/script.js"></script>



    <style>


        a {
        
        
        color:black;
        
        }

        a:hover {

    text-decoration:none;
}
    </style>



</head>
<body>
  
          <nav class="menu1  container-fluid">
            <div class="logo col-md-3">
                <a href="Home.php">
       
                    <img src="../Images/logo.png" width="150px" />
                </a>
                <p style="margin-top: -20px">Green Institue of Technology</p></div>
            <div class="col-md-4"></div>



        </nav>
<div class="row"  >


            <div class="col-sm-12 maindiv coursesinfo "  >
                
				
				                        <?php
										if(isset($_POST['submit'])&& $Error==""){
											$name=$_POST['name'];
											$email=$_POST['email'];
											
											echo'<div class="col-sm-4"></div><div class="col-sm-8"><h3>Congratulations!</h3>
											<p>'.$name.', thank you for Registeration.<br/>
											You will soon be infromed about your Registeration on <strong>'.$email.'</strong></p>
											<br/>
											<br/>
											<br/>
											<br/>
											<a href="Courses.php">Return To Courses </a></div><div class="col-sm-4></div>';
											
											
											
										}else if(isset($_GET['act'])){
										if($_GET['act']=="Enroll"){
											$email="";
											$name=$_SESSION['User_Name'];
											$cid=$_SESSION['User_ID'];
											$query1="Select Email as nmm from GIT_User where GIT_UserID='$cid' limit 1";
                                            $outR=mysqli_query($conn,$query1);
                                            foreach($outR as $ress){$email=$ress['nmm'];}
									
											
											echo'<h3>Congratulations!</h3>
											<p>'.$name.', thank you for Registeration.<br/>
											You will soon be infromed about your Registeration on <strong>'.$email.'</strong></p>
											<br/>
											<br/>
											<br/>
											<br/>
											<a href="Courses.php">Return To Courses </a>';
											
											
										}
										}
											
											
											
										
										else{
										echo '<span><strong>'.$Error.'</strong></spna><br/><div class="container">
  <h2>Registeration form</h2>
  <form class="form-horizontal" role="form" action="Enroll.php?cid='.$_GET['cid'].'" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password">
      </div>
    </div>
        <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">          
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="age">Age:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="age" name="age" placeholder="Enter Age">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="gender">Gender:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="address">Address:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter your address"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="phone">Phone:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Mobile Number">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="cnic">CNIC:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="cnic" name="cnic" placeholder="Enter CNIC">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>';
										}			
										
										
 ?>
            



                

            </div>
</div>

        
</body>
</html>
<?php
mysqli_close($conn);
?>