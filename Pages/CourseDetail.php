<?php
Session_start();
$user="root";
$pass="alam";
$database="GIT_SE";


$conn= mysqli_connect('localhost',$user,$pass,$database);



?>

<?php
							$theID=$_GET['id'];
							$About="";
							$Pricing="";
							$Creators="";
							$Path="";
							$queryDesc="select * from Course_Description where Course_ID='$theID' limit 1";
							$result=mysqli_query($conn,$queryDesc);
							foreach($result as $res){
								$About=$res['About_Course'];
								$Pricing=$res['Course_Pricing'];
								$Creators=$res['Course_Creators'];
								$Path=$res['Image_Path'];
							}
							
							?>



<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Courses</title>
    <link href="../Style Sheets/CoursesIn.css" type="text/css" rel="stylesheet" />

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
            color: black;
        }

            a:hover {
                text-decoration: none;
            }
    </style>



</head>
<body>
   

        <nav class="menu1  container-fluid">
            <div class="logo col-md-3">
                <a href="Home.php">
                    <img src="../Images/logo.png" width="150px" /></a>
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
            <div class="col-md-12 welcomeDiv" style="background-image: url(<?php echo $Path;?>)"></div>
        </div>


        <div class="row">
            <div class="container-fluid text-center fixed">
                <div class="leftrow content ">

                    <div class="col-sm-2  sidenav container-fixed ">

                        <div class="list-group courses">
                            <a href="#about" class="list-group-item ">About</a>
                            <a href="Courses.php" class="list-group-item" id="3d">Courses</a>
                            <a href="#pricing" class="list-group-item" id="mg">Pricing</a>
                            <a href="#creators" class="list-group-item" id="mo">Creators</a>

                        </div>

                        <div class="list-group-item">
                            <h3>3D Graphics</h3>
                            <span>Price:<p id="CoursePrice"><?php
							$theID=$_GET['id'];
							$Price=0;
							$queryPrice="select Course_Fee as fee from course where Course_ID='$theID'";
							$result=mysqli_query($conn,$queryPrice);
							foreach($result as $res){
								$Price=$res['fee'];
							}
							echo "PKR".$Price;
							?></p>
                            </span>
                        </div>

                        <div class="list-group">
                            <?php
							
							$theID=$_GET['id'];
							if(isset($_SESSION['User_ID'], $_SESSION['User_Name'])){
								$count=0;	
$uID=$_SESSION['User_ID'];
$cid=$_GET['id'];
$queryCheck="select * from GIT_Student where Course_ID='$cid' and User_ID='$uID' ";
$result=$conn->query($queryCheck);
$count=$result->num_rows;
if($count>=1){
echo '<a href="CourseLive.php?id='.$theID.'">
                                <div class="Enrol">
                                    <strong>Live</strong>
                                </div>
                            </a>';
}else{
	echo '<a href="Enroll.php?cid='.$theID.'&act=Enroll">
                                <div class="Enrol">
                                    <strong>Enroll</strong>
                                </div>
                            </a>';
	
}
								
							}
							else {
								echo '<a href="Enroll.php?cid='.$theID.'">
                                <div class="Enrol">
                                    <strong>Enroll</strong>
                                </div>
                            </a>';}
							?>
                        </div>

                    </div>
                </div>




                <div class="col-sm-8 maindiv coursesinfo ">
                


                    <div class=" coursediv" id="about">


                        <div class="col-sm-12">
                            <h3>About This Course</h3>
                            <p><?php echo $About; ?></p>

                        </div>

                    </div>


                    <div class=" coursediv" id="content">


                        <div class="col-sm-12">
                            <h3>Content</h3>
                           <?php
                   $theID=$_GET['id'];
				   $query="select * from Course_Content where Course_ID='$theID' order by Lecture_ID asc";
				   $result=mysqli_query($conn,$query);
				   Foreach($result as $res){
					   $num=$res['Lecture_ID'];
					   $desc=$res['Lecture_Description'];
					echo '<h4>Lecture '.$num.'</h4>
					<p>'.$desc.'</p><br/>'; 
				   }
					   
					   
					   ?>

                        </div>
                        <div class=" text-left col-sm-1">
                        </div>
                    </div>

                    <div class=" coursediv" id="pricing">


                        <div class="col-sm-12">
                            <h3>Pricing</h3>
                            <p><?php echo $Pricing; ?></p>

                        </div>
                        <div class=" text-left col-sm-1">
                        </div>
                    </div>

                    <div class=" coursediv" id="creators">


                        <div class="col-sm-12">
                            <h3>Creators</h3>
                            <p><?php echo $Creators; ?></p>

                        </div>
                        <div class=" text-left col-sm-1">
                        </div>
                    </div>
                <br/><br/><br/><br/>
				<div class=" commentdiv">
                 <h3>Comments</h3>
                 <?php 					
				 $cid=$_GET['id'];
				 $query="select * from git_comments where Course_ID='$cid'";
                 $result=mysqli_query($conn,$query);
				
foreach($result as $res){
$cname="";	
			$theID=$res['User_ID'];
            $theComm=$res['Comment'];
			$theDate=$res['Date'];			
			$query1="Select Name as nmm from GIT_User  where GIT_UserID='$theID' limit 1";
     $outR=mysqli_query($conn,$query1);
foreach($outR as $ress){$cname=$ress['nmm'];}	

                       echo '<div class="col-sm-10 comment">
                            <h4>'.$cname.'<span class="pull-right">'.$theDate.'</span></h4><hr/>
                            <p>'.$theComm.'</p>

                        </div>
                        <div class="col-sm-2">
</div>';}?>
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