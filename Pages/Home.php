
<?php
session_start();
$user="root";
$pass="alam";
$database="GIT_SE";
$conn= mysqli_connect('localhost',$user,$pass,$database);

$msg="";
if(isset($_POST['submit'])) { 


$id=$_POST['userid'];
$pas=$_POST['password']; 
if(!empty($_POST['userid'])) 
{ 
$query = "SELECT * FROM GIT_User where GIT_UserID = '$id' AND User_Password = '$pas' limit 1";
$result=$conn->query($query) ;

if($result->num_rows==1)
{ $name="";
$query1="select Name as nm from GIT_User where GIT_UserID='$id' limit 1";
$result=mysqli_query($conn,$query1);
foreach($result as $res){$name=$res['nm'];}
$_SESSION['User_ID'] = $_POST['userid']; 
$_SESSION['User_Name'] = $name;
} 
else 
{ 
$msg= "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY..."; }
}
 } 






?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Home</title>
    <link href="../Style Sheets/Home2.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>
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
<body >

        <nav class="menu1  container-fluid">
            <div class="logo col-md-3">
                <a href="Home.php">
           
                    <img src="../Images/logo.png" width="150px" />
                </a>
                <p style="margin-top: -20px"><strong>Green Institue of Technology</strong></p> </div>
            <div class="col-md-4"></div>

            <div class="col-md-12">

              
				<?php
				
				if(isset($_SESSION['User_ID'], $_SESSION['User_Name'])){
					$theID=$_SESSION['User_ID'];
					echo '<nav class="navbar navbar"  >
	<div class="container-fluid">
	
	 <div class="navbar-header">
      <span class="navbar-brand">Hello '.$_SESSION['User_Name'].'</span>
    </div>
	<ul class="nav navbar-nav" >';
	$query="Select * from GIT_Student where User_ID='$theID'";
	$result=mysqli_query($conn,$query);
	$cname="";
foreach($result as $res){
	
	$cid=$res['Course_ID'];
     $query1="Select Course_Name as nmm from Course where Course_ID='$cid' limit 1";
     $outR=mysqli_query($conn,$query1);
foreach($outR as $ress){$cname=$ress['nmm'];}
	 
	 echo '<li><a style="color: #bb0000;" href="CourseLive.php?id='.$cid.'" >'.$cname.'</a></li>';

}



echo '</ul>

	 <ul class="nav navbar-nav navbar-right">
      <li><a style="color: #bb0000;" href="Profile.php?id='.$theID.'"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
      <li><a style="color: #bb0000;" href="LogoutUser.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
 
	</ul>
</div>
</nav>';
					
					
					
				}else {
				echo '<form class="form-inline pull-right" action="Home.php" method="post">
            
                        <div class="form-group"><strong>User ID:</strong><input type="text" name="userid" value=""/></div>
                    
                    
                        <div class="form-group"><strong>Password:</strong><input type="password" name="password" value=""/></div>
               

                  
                    
   
                       <input type="submit" name="submit" value="Login" class="btn btn-default"/>
                   
			    </form>';
				echo $msg;}
				?>
               


            </div>

        </nav>


        <div class="container-fluid text-center">
            <div class="leftrow content ">

                <div class="col-sm-2  sidenav">

                    <div class="list-group courses">
					 <a href="Courses.php" class="list-group-item">Courses</a>
					<?php
					$query="select * from courses_category ";
                    $result=mysqli_query($conn,$query);
				
foreach($result as $res){					
			$theName=$res['Cat_Name'];		
					
    echo '<a href="Course.php?id='.$theName.'" class="list-group-item">'.$theName.'</a>';
}    
					  ?>
                    </div>
                </div>
            </div>




            <div class="col-sm-8 maindiv text-center">
			
			<h1 style="color:##c0cfbc">Hundreds of Specializations and courses 
			                            in business, computer science, 
										data science,and more.</h1>
		
            </div>
<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>


            <div class="col-sm-2 sidenav announcement">
                <h3>Announcments</h3>
                <div class="well">
                  					<?php
					$query="select * from GIT_Announcements order by Ann_Date desc";
                    $result=mysqli_query($conn,$query);
				
foreach($result as $res){					
			$theName=$res['Ann_Msg'];		
			$theDate=$res['Ann_Date'];		
    echo '<p >'.$theName.' <br/>On Date:'.$theDate.'</p><hr/>';
}    
					  ?>
                </div>

            </div>

        </div>

        <footer class="container-fluid text-center float-bottom">
		
		<p>&copy  CopyRights 2016.Design & Developed by The Team</p>
	</footer>
 
</body>
</html>
<?php
mysqli_close($conn);
?>