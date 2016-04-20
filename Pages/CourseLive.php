<?php
session_start();
if(!isset($_SESSION['User_ID'],$_SESSION['User_Name'])){
header("Location:Home.php");
	
}
$user="root";
$pass="alam";
$database="GIT_SE";
$conn= mysqli_connect('localhost',$user,$pass,$database);

if(isset($_SESSION['User_ID'],$_SESSION['User_Name'])){
$count=0;	
$theID=$_SESSION['User_ID'];
$cid=$_GET['id'];
$queryCheck="select * from GIT_Student where Course_ID='$cid' and User_ID='$theID' ";
$result=$conn->query($queryCheck);
$count=$result->num_rows;
if($count==0){
header("Location:Home.php");
}
}
if(isset($_POST['submit'])){
	if($_POST['comment']!=""){
	$theID=$_SESSION['User_ID'];
    $cid=$_GET['id'];	
	$query="INSERT INTO git_comments ( Comment, Course_ID, User_ID) VALUES('".$_POST['comment']."', '$cid','$theID')";
    mysqli_query($conn,$query);	
		
		
	}
	
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
	body{
		background-image:url("../Images/courselivebackground.jpg");
		    background-size:100%;
    background-attachment: fixed;
	
	}
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
                <p style="margin-top: -20px">Green Institue of Technology</p>
            </div>
              <div class="col-md-4"></div>

            <div class="col-md-12">

              
				<?php
				
			
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
               
				       ?>
</div>
</nav>
		
		



        <div>
          
-->


                <div>

                   <?php
                   $theID=$_GET['id'];
				   $query="select * from Course_Content where Course_ID='$theID' order by Lecture_ID asc";
				   $result=mysqli_query($conn,$query);
				   Foreach($result as $res){
					   $num=$res['Lecture_ID'];
					   $desc=$res['Lecture_Description'];
					   $Ppath=$res['Pdf_Path'];
					   $Vpath=$res['Video_Path'];
					   
					   
					   
					   
                   echo ' <div class=" courselivediv container " >
							

                        
                            <h3>Lecture<span> '.$num.'</span></h3>
                            <hr style="color:black;border-color:black">
							<p>'.$desc.'</p><br/><br/><br/>
                            <div class="btn btn-success"  ><a href="download.php?file="'.$Ppath.'">DOWLOAD Lecture '.$num.'</a></div>                        
						<br/>
						<br/>
		
						
						<video class="container" width="450px" height="500px" controls="controls">
                        <source src="'.$Vpath.'" type="video/mp4" >
						<source src="'.$Vpath.'.ogg" type="video/ogg">
                        					
					
						
						
						
						</div>

				   </div>';}

                    ?>


                    <div class=" commentdiv container">
					<h3>Comments</h3>
					<?php
									 $query="select * from git_comments ";
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
</div>';}

echo '
  
  <form class="form-horizontal" role="form" action="CourseLive.php?id='.$_GET['id'].'" method="post">
  <div class="form-group">
      
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="comment" name="comment" placeholder="Comment..."></textarea>
      </div>
    </div>
<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-default">Comment</button>
      </div>
    </div>
	 </form>
';

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