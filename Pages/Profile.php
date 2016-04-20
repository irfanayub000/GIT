
<?php
SESSION_START();
if(!isset($_SESSION['User_ID'])){
header("Location:Home.php");
	
}else if($_SESSION['User_ID']!=$_GET['id']){
	
	header("Location:Home.php");
}
$user="root";
$pass="alam";
$database="GIT_SE";


$conn= mysqli_connect('localhost',$user,$pass,$database);
$msg="";
if(isset($_POST['submit'])){
	
	if(isset($_GET['act'])){
		if($_GET['act']=="Pass"){
		$Pass="";
		$theID=$_GET['id'];
		$thePass=$_POST['Pass1'];
			$queryCheckPass="select * from GIT_User where GIT_UserID='$theID' limit 1";
			$result=mysqli_query($conn,$queryCheckPass);
							foreach($result as $res){
								$Pass=$res['User_Password'];
						
							}
						
		if(($Pass==$thePass)&&($_POST['Pass2']==$_POST['Pass3'])) {
			
				$queryPass="UPDATE GIT_User
SET User_Password='".$_POST['Pass2']."'
WHERE GIT_UserID='$theID'";
			mysqli_query($conn,$queryPass);
		//header("Location:Home.php");
			$msg="Password Changed!";
		}else{
			
			$msg="Password Mismatch! Please retry.";
		}
		
		
		
		
	}}
	else{
			$theID=$_GET['id'];
			$queryUpdate="UPDATE GIT_User
SET Address='".$_POST['Address']."', Phone='".$_POST['Phone']."'
WHERE GIT_UserID='$theID'";
			$result=mysqli_query($conn,$queryUpdate);
		header("Location:Home.php");
	}
}



?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
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


        <nav class="menu1  container-fluid">
            <div class="logo col-md-3">
                <a href="Home.php">
           
                    <img src="../Images/logo.png" width="150px" />
                </a>
                <p style="margin-top: -20px">Green Institue of Technology</p> </div>
            <div class="col-md-4"></div>

            <div class="col-md-5 login text-right ">

                <div style="padding: 20px">
                  <?php $theID=$_GET['id'];
                echo'  <a style="color:black;" href="Profile.php?id='.$theID.'&act=Pass" >Change Password</a>';
   ?>
                        
                    </div>
                </div>


            </div>

        </nav>


        <div class="container-fluid text-center">
         



            <div class="col-sm-10 maindiv">
			<div class="container">
			<?php
		if(isset($_GET['act'])){
			if($_GET['act']=="Pass"){
			echo '	 <div class="container">
  <h2>Change Password</h2><br/><br/><br/><br/><span>'.$msg.'</span>
  <form class="form-horizontal" role="form" action="Profile.php?id='.$_GET['id'].'&act=Pass" method="post">
      <div class="form-group">
      <label class="control-label col-sm-2" for="Pass1">Current Password:</label>
 <div class="col-sm-10">          
        <input type="password" class="form-control" id="Pass1" name="Pass1" value=""/>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="Pass2">New Password:</label>
 <div class="col-sm-10">          
        <input type="password" class="form-control" id="Pass2" name="Pass2" value=""/>
      </div>
    </div>
  <div class="form-group">
      <label class="control-label col-sm-2" for="Pass3">Confirm Password:</label>
 <div class="col-sm-10">          
        <input type="password" class="form-control" id="Pass3" name="Pass3" value=""/>
      </div>
    </div>
	<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-default">Change Password</button>
      </div>
    </div>
	 </form>
</div>';
			
			
		}
		}else{
			$theID=$_GET['id'];
			$query="select * from GIT_User where GIT_UserID='$theID' limit 1";
			$result=mysqli_query($conn,$query);
							foreach($result as $res){
								$Addr=$res['Address'];
								$Phone=$res['Phone'];
								$nam=$res['Name'];
							}
							
							
			echo ' <div class="container">
  <h2>'.$nam.'</h2><br/><br/><br/><br/>
  <form class="form-horizontal" role="form" action="Profile.php?id='.$_GET['id'].'" method="post"><div class="form-group">
      <label class="control-label col-sm-2" for="Address">Address:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="Address" name="Address" >'.$Addr.'</textarea>
      </div>
    </div>
	 <div class="form-group">
      <label class="control-label col-sm-2" for="Phone">Phone:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="Phone" name="Phone" value="'.$Phone.'"/>
      </div>
    </div>
	<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-default">Update</button>
      </div>
    </div>
	 </form>
</div>';
		}	
			
			?>
		</div>
            </div>

   <div class="rightrow content ">

                <div class="col-sm-2 ">

               
                </div>
            </div>


         

        </div>

        <footer class="container-fluid text-center float-bottom">
            <p>&copy  CopyRights 2016.Designed & Developed by The Team</p>
        </footer>

</body>
</html>
<?php
mysqli_close($conn);
?>