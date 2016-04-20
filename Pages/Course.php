
<?php
Session_start();
$user="root";
$pass="alam";
$database="GIT_SE";


$conn= mysqli_connect('localhost',$user,$pass,$database);
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Courses</title>
    <link href="../Style Sheets/Courses.css" type="text/css" rel="stylesheet" />

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
                    <img src="../Images/logo.png" width="150px" /> </a>
                <p style="margin-top: -20px">Green Institue of Technology</p> </div>
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
                }
				else {
			echo '<form class="form-inline pull-right" action="Home.php" method="post">
                        <div class="form-group"><strong>User ID:</strong><input type="text" name="userid" value=""/></div>
                        <div class="form-group"><strong>Password:</strong><input type="password" name="password" value=""/></div>
                        <input type="submit" name="submit" value="Login" class="btn btn-default"/>
                  </form>';}
				       ?>
</div>
</nav>
            

        <div class="row">
        <div class="container-fluid text-center fixed">
            <div class="leftrow content ">

                <div class="col-sm-2  sidenav container-fixed ">

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




            <div class="col-sm-8 maindiv coursesinfo "  >
                
				
				                        <?php
										
									$cat=$_GET['id'];
$query="select * from Course where Cat_Name='$cat'";
											
										
                    $result=mysqli_query($conn,$query);
				
foreach($result as $res){	
            $theID=$res['Course_ID'];				
			$theName=$res['Course_Name'];		
			
            $thedesc=$res['Course_Desc'];
	echo '    <a href="CourseDetail.php?id='.$theID.'">
                <div class=" coursediv" >

                    <div class="col-sm-3">
                        <img src="../Images/3dgraphics.jpg" width="150px" />

                    </div>
                    <div class="col-sm-9">
                        <h3>'.$theName.'</h3>
                        <p>'.$thedesc.'</p>

                    </div>
                    <div class=" text-left col-sm-1">
                    </div>
                </div></a>';
}    
					  ?>
            



                

            </div>


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
            </div>
        <footer class="container-fluid text-center">
            <p>&copy  CopyRights 2016.Design & Developed by The Team</p>
        </footer>
 
</body>
</html>
<?php
mysqli_close($conn);
?>