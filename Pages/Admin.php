
<?php
SESSION_START();
if(!isset($_SESSION['Admin_ID'])){
header("Location:AdminLogin.php");
	
}
$user="root";
$pass="alam";
$database="GIT_SE";


$conn= mysqli_connect('localhost',$user,$pass,$database);


if(isset($_POST['submit'])){
	if($_GET['id']=="Category"){
		if($_GET['act']=="Add"){
		$query="INSERT INTO course (Course_ID, Course_Name, Course_Desc, Course_Duration, Cat_Name, Course_Fee) VALUES('".$_POST['courseid']."', '".$_POST['name']."','".$_POST['description']."','".$_POST['duration']."', '".$_GET['cid']."', '".$_POST['fee']."')";
        mysqli_query($conn,$query);
		}
		else if($_GET['act']=="AddCat"){
		$queryy="INSERT INTO courses_category (Course_ID, Cat_Name, Cat_Disc) VALUES('".$_POST['catid']."', '".$_POST['name']."','".$_POST['description']."')";
        mysqli_query($conn,$queryy);
		
		}
        else if($_GET['act']=="Edit"){
		$queryy="update courses_category set Course_ID='".$_POST['catid']."', Cat_Name='".$_POST['name']."', Cat_Disc='".$_POST['description']."' where Cat_Name='".$_GET['cid']."'";
        $query="update course set Cat_Name='".$_POST['name']."' where Cat_Name='".$_GET['cid']."'";
		mysqli_query($conn,$query);
		mysqli_query($conn,$queryy);
		
		}
	}else if($_GET['id']=="Announcements"){
		if($_GET['act']=="AddAnn"){
		$query="INSERT INTO GIT_Announcements (Ann_ID, Ann_Msg) VALUES('".$_POST['Annid']."', '".$_POST['description']."')";
        mysqli_query($conn,$query);
    }
	}else if($_GET['id']=="Courses"){
		if($_GET['act']=="Description"){
		$theID=$_GET['cid'];	
		//$query="delete from Course_Description where Course_ID='$theID'";
        //mysqli_query($conn,$query);
		$query1="INSERT INTO Course_Description (Course_ID, About_course,Course_Pricing, Course_Creators, Image_Path) VALUES('".$_GET['cid']."', '".$_POST['about']."', '".$_POST['pricing']."', '".$_POST['creator']."', '".$_POST['path']."')";
		mysqli_query($conn,$query1);
		header("Location:Admin.php?id=Courses");
    }else if($_GET['act']=="Content"){
		$theID=$_GET['cid'];
        $LID=$_POST['LecID'];		
		$query="delete from Course_Content where Course_ID='$theID' and Lecture_ID='$LID'";
        mysqli_query($conn,$query);
		$query1="INSERT INTO Course_Content (Lecture_ID,Course_ID, Lecture_Description,Pdf_Path, Video_Path) VALUES( '".$_POST['LecID']."','".$_GET['cid']."', '".$_POST['description']."', '".$_POST['PdfPath']."', '".$_POST['VideoPath']."')";
		mysqli_query($conn,$query1);
		
	}
		
		
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
                    <div class="col-md-12 text-right">
                        <a href="Logout.php" ><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </div>
                  
   
                        
                    </div>
                </div>


            </div>

        </nav>


        <div class="container-fluid text-center">
         



            <div class="col-sm-10 maindiv">
			<div class="container">
			<?php
			if(isset($_GET['id'])){
				
				if($_GET['id']=="Students")               //Students section 
				{
							if(isset($_GET['cid'])&&(isset($_GET['act']))){
					if($_GET['act']=="Delete"){
						$del=$_GET['cid'];
					$query="delete from GIT_User where GIT_UserID='$del'";
					$query1="delete from GIT_Student where User_ID='$del'";
                    mysqli_query($conn,$query);
					mysqli_query($conn,$query1);
  					header("Location:Admin.php?id=Students");
					}
					}
					else{
					
					
					
					$query="select * from GIT_User ";
                    $result=mysqli_query($conn,$query);
			echo '<table class="table table-striped">
    <thead >
      <tr>
	    <th align="center">User ID</th>
        <th align="center">Name</th>
        <th align="center">Courses</th>
        <th align="center">Email</th>
        <th align="center">Age</th>
		<th align="center">Gender</th>
		<th align="center">Phone</th>
		<th align="center">Address</th>
		<th align="center">CNIC</th>
		<th align="center">Delete</th>
		
      </tr>
    </thead>
    <tbody>';	
foreach($result as $res){	
            $id=$res['GIT_UserID'];
  $query2="SELECT Course_ID FROM git_student WHERE User_ID='$id'";
			$result1=mysqli_query($conn,$query2);		
			$theName=$res['Name'];
            $theEmail=$res['Email'];
			$theAge=$res['Age'];
			$thePhone=$res['Phone'];
			$theCnic=$res['CNIC'];
			$theAddr=$res['Address'];
			$theGender=$res['Gender'];
		
  echo '<tr>
        <td align="left">'.$id.'</td>
        <td align="left">'.$theName.'</td>
		<td align="left">';
		foreach($result1 as $res1){
			
			echo $res1['Course_ID'];
			echo ", ";
		}
			echo '</td>
        <td align="left">'.$theEmail.'</td>
        <td align="left">'.$theAge.'</td>
		<td align="left">'.$theGender.'</td>
        <td align="left">'.$thePhone.'</td>
        <td align="left">'.$theAddr.'</td>
        <td align="left">'.$theCnic.'</td>    	
		<td align="left"><a href="Admin.php?id=Students&cid='.$id.'&act=Delete" >Delete</a></td>
      </tr>';
}   						
echo '</tbody></table>';	
							
							
							
					}	
					
					
				}else if($_GET['id']=="Category")                 //Category Section
				{
					if(isset($_GET['cid'])&&(isset($_GET['act']))){
						if($_GET['act']=="Edit"){
						echo '
	
	<div class="container">
  <h2>Category Form</h2>
  <form class="form-horizontal" role="form" action="Admin.php?id=Category&cid='.$_GET['cid'].'&act=Edit" method="post">
   <div class="form-group">
      <label class="control-label col-sm-2" for="catid">ID:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="catid" name="catid" placeholder="Enter Category ID">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Category Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="name" name="name" value="'.$_GET['cid'].'">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="description">Description:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
      </div>
    </div>
	<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
	 </form>
</div>';	
						}else if($_GET['act']=="Add"){
							echo '
	
	<div class="container">
  <h2>Course Form</h2>
  <form class="form-horizontal" role="form" action="Admin.php?id=Category&cid='.$_GET['cid'].'&act=Add" method="post">
   <div class="form-group">
      <label class="control-label col-sm-2" for="courseid">Course ID:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="courseid" name="courseid" placeholder="Enter Course ID">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Course Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Course Name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="description">Course Description:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
      </div>
    </div>
	    <div class="form-group">
      <label class="control-label col-sm-2" for="duration">Course Duration:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="duration" name="duration" placeholder="Enter Course Duration">
      </div>
    </div>
	    <div class="form-group">
      <label class="control-label col-sm-2" for="fee">Course Fee:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="fee" name="fee" placeholder="Enter Course Fee">
      </div>
    </div>
	<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
	 </form>
</div>';
						}else if($_GET['act']=="Delete"){
						$del=$_GET['cid'];
					    $query="delete from course where Cat_Name='$del'";
						$queryy="delete from courses_category where Cat_Name='$del'";
                        mysqli_query($conn,$query);
						mysqli_query($conn,$queryy);
  					    header("Location:Admin.php?id=Category");	
						
						}else if($_GET['act']=="AddCat"){
							
							echo '
	
	<div class="container">
  <h2>Category Form</h2>
  <form class="form-horizontal" role="form" action="Admin.php?id=Category&cid=xyz&act=AddCat" method="post">
   <div class="form-group">
      <label class="control-label col-sm-2" for="catid">ID:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="catid" name="catid" placeholder="Enter Category ID">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Category Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="description">Description:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
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
						
						
					}
					else{
					$query="select * from courses_category ";
                    $result=mysqli_query($conn,$query);
			echo '<table class="table table-striped">
    <thead >
      <tr>
        
        <th align="center">Category Name</th>
        <th align="center">Edit</th>
		<th align="center">Add Course</th>
		<th align="center">Delete</th>
      </tr>
    </thead>
    <tbody>';	
foreach($result as $res){					
			$theCName=$res['Cat_Name'];		
	
  echo '<tr>
        <td align="left">'.$theCName.'</td>
     
		<td align="left"><a href="Admin.php?id=Category&cid='.$theCName.'&act=Edit" >Edit</a></td>
	    <td align="left"><a href="Admin.php?id=Category&cid='.$theCName.'&act=Add" >Add Course</a></td>
	    <td align="left"><a href="Admin.php?id=Category&cid='.$theCName.'&act=Delete" >Delete</a></td>
      </tr>';
}   						
echo '</tbody>
</table></br>
<a href="Admin.php?id=Category&cid=xyz&act=AddCat" >Add Category</a>';
					
					
					}	
				}else if($_GET['id']=="Courses")                  //Courses Section
				{
					if(isset($_GET['cid'])&&(isset($_GET['act']))){
					if($_GET['act']=="delete"){
						$del=$_GET['cid'];
					$query="delete from course where Course_ID='$del'";
						$query1="delete from GIT_Student where Course_ID='$del'";
                    mysqli_query($conn,$query1);
                    mysqli_query($conn,$query);
  					header("Location:Admin.php?id=Courses");
					}else if($_GET['act']=="Description"){
						$theID=$_GET['cid'];
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
						
					echo '
	
		<div class="container">
  <h2>Description Form</h2>
  <form class="form-horizontal" role="form" action="Admin.php?id=Courses&cid='.$_GET['cid'].'&act=Description" method="post">
  <div class="form-group">
      <label class="control-label col-sm-2" for="about">About Course:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="about" name="about" >'.$About.'</textarea>
      </div>
    </div>
 <div class="form-group">
      <label class="control-label col-sm-2" for="pricing">Pricing:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="pricing" name="pricing" >'.$Pricing.'</textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="creator">Creators:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="creator" name="creator" >'.$Creators.'</textarea>
      </div>
    </div>
	 <div class="form-group">
      <label class="control-label col-sm-2" for="path">Welcome Image Path:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="path" name="path" value="'.$Path.'"/>
      </div>
    </div>
	<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
	 </form>
</div>';	
						
					}else if($_GET['act']=="Content"){
						$idCounter=0;
						$theID=$_GET['cid'];
                        $query="Select * from Course_Content where Course_ID='$theID'";
                        $result=$conn->query($query);
                        $idCounter=$result->num_rows;
						$idCounter++;

						
						
						
					echo '
	
	<div class="container">
  <h2>Content Form</h2>
  <form class="form-horizontal" role="form" action="Admin.php?id=Courses&cid='.$_GET['cid'].'&act=Content" method="post">
   <div class="form-group">
      <label class="control-label col-sm-2" for="LecID">Lecture ID:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="LecID" name="LecID" value="'.$idCounter.'"/>
      </div>
    </div>
	   <div class="form-group">
      <label class="control-label col-sm-2" for="description">Description:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="PdfPath">Document Path:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="PdfPath" name="PdfPath" placeholder="Enter Pdf Path">
      </div>
    </div>
 
	    <div class="form-group">
      <label class="control-label col-sm-2" for="VideoPath">Video Path:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="VideoPath" name="VideoPath" placeholder="Enter Video Path">
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
					}
					else{	
					$query="select * from course ";
                    $result=mysqli_query($conn,$query);
			echo '<table class="table table-striped">
    <thead >
      <tr>
        <th align="center">Course ID</th>
        <th align="center">Course Name</th>
        <th align="center">Course Category</th>
		<th align="center">View</th>
		<th align="center">Description</th>
		<th align="center">Content</th>
		<th align="center">Delete</th>
      </tr>
    </thead>
    <tbody>';	
foreach($result as $res){					
			$theCName=$res['Cat_Name'];		
			$theName=$res['Course_Name'];
            $theID=$res['Course_ID'];
  echo '<tr>
        <td align="left">'.$theID.'</td>
        <td align="left">'.$theName.'</td>
        <td align="left">'.$theCName.'</td>
		<td align="left"><a href="CourseDetail.php?id='.$theID.'">View</td>
		<td align="left"><a href="Admin.php?id=Courses&cid='.$theID.'&act=Description" >Add/Update</a></td>
		<td align="left"><a href="Admin.php?id=Courses&cid='.$theID.'&act=Content" >Add/Update</a></td>
		<td align="left"><a href="Admin.php?id=Courses&cid='.$theID.'&act=delete" >Delete</a></td>
      </tr>';
}   						
echo '</tbody>
					</table>';			}		

                }else if($_GET['id']=="Requests")              //Requests Section
				{
						if(isset($_GET['cid'])&&(isset($_GET['act']))){
							if($_GET['act']=="Reject"){
						$del=$_GET['cid'];
					$query="delete from GIT_User_Request where Temp_ID='$del'";
                    mysqli_query($conn,$query);
  					header("Location:Admin.php?id=Requests");
					}
					else if($_GET['act']=="Accept"){
						$acc=$_GET['cid'];
						$query="select * from GIT_User_Request where Temp_ID='$acc' limit 1";
						$result=mysqli_query($conn,$query);
							$idCount=0;
	$queryHigh="SELECT MAX(GIT_UserID) AS High FROM GIT_User";
	$result1=mysqli_query($conn,$queryHigh);
	foreach($result1 as $res1){
		$idCount=$res1['High'];
	}
	$idCount++;
	
foreach($result as $res){
	         
							
            if($res['Active']=="No"){
				$id=$idCount;
				
			}
			$id=$res['Active'];
			$theReq=$res['Request_For'];		
			$theName=$res['Name'];
            $theEmail=$res['Email'];
			$theAge=$res['Age'];
			$thePhone=$res['Phone'];
			$theCnic=$res['CNIC'];
			$theAddr=$res['Address'];
			$theGender=$res['Gender'];
			$thePass=$res['User_Password'];
		    $queryy="INSERT INTO GIT_User (GIT_UserID, Name, User_Password, Email,Age, Gender,Address,Phone,CNIC) VALUES('$id', '$theName','$thePass', '$theEmail', '$theAge','$theGender','$theAddr','$thePhone','$theCnic')";
            $query2="INSERT INTO GIT_Student (User_ID,Course_ID) VALUES('$id', '$theReq')";
			if ($res['Active']=="No"){
				mysqli_query($conn,$queryy);}
			mysqli_query($conn,$query2);
}

$query1="delete from GIT_User_Request where Temp_ID='$acc'";
                    mysqli_query($conn,$query1);
  					header("Location:Admin.php?id=Requests"); 
					}	
						}
						else{
					$query="select * from GIT_User_Request ";
                    $result=mysqli_query($conn,$query);
			echo '<table class="table table-striped">
    <thead >
      <tr>
        <th align="center">User Name</th>
        <th align="center">Course Requested</th>
        <th align="center">Email</th>
        <th align="center">Age</th>
		<th align="center">Phone</th>
		<th align="center">CNIC</th>
		<th align="center">Accept</th>
		<th align="center">Reject</th>
      </tr>
    </thead>
    <tbody>';	
foreach($result as $res){					
			$theReq=$res['Request_For'];		
			$theName=$res['Name'];
            $theEmail=$res['Email'];
			$theAge=$res['Age'];
			$thePhone=$res['Phone'];
			$theCnic=$res['CNIC'];
			$theID=$res['Temp_ID'];
  echo '<tr>
        
        <td align="left">'.$theName.'</td>
		<td align="left">'.$theReq.'</td>
        <td align="left">'.$theEmail.'</td>
        <td align="left">'.$theAge.'</td>
        <td align="left">'.$thePhone.'</td>
        <td align="left">'.$theCnic.'</td>    	
		<td align="left"><a href="Admin.php?id=Requests&cid='.$theID.'&act=Accept" >Accept</a></td>
		<td align="left"><a href="Admin.php?id=Requests&cid='.$theID.'&act=Reject" >Reject</a></td>
      </tr>';
}   						
echo '</tbody></table>';	
							
							
							
							
						}
				}else if($_GET['id']=="Messages")                    //Messages Section
				{
						echo "msg";
				}else if($_GET['id']=="Announcements")               //Announcement Section
				{
					
					if(isset($_GET['cid'])&&(isset($_GET['act']))){
						if($_GET['act']=="delete"){
						$del=$_GET['cid'];
					$query="delete from GIT_Announcements where Ann_ID='$del'";
                    mysqli_query($conn,$query);
  					header("Location:Admin.php?id=Announcements");
					}else if($_GET['act']=="AddAnn"){
						echo '
	
	<div class="container">
  <h2>Announcement Form</h2>
  <form class="form-horizontal" role="form" action="Admin.php?id=Announcements&cid=xyz&act=AddAnn" method="post">
   <div class="form-group">
      <label class="control-label col-sm-2" for="Annid">Announcement ID:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="Annid" name="Annid" placeholder="Enter Announcement ID"/>
      </div>
    </div>
	   <div class="form-group">
      <label class="control-label col-sm-2" for="description">Description:</label>
      <div class="col-sm-10">          
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
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
						
					}
					else{
					$query="select * from GIT_Announcements ";
                    $result=mysqli_query($conn,$query);
			echo '<table class="table table-striped">
    <thead >
      <tr>
        <th align="center">Announcement ID</th>
        <th align="center">Announcement</th>
        <th align="center">Date</th>
        <th align="center">Delete</th>
      </tr>
    </thead>
    <tbody>';	
foreach($result as $res){					
			$theDate=$res['Ann_Date'];		
			$theName=$res['Ann_Msg'];
            $theID=$res['Ann_ID'];
  echo '<tr>
        <td align="left">'.$theID.'</td>
        <td align="left">'.$theName.'</td>
        <td align="left">'.$theDate.'</td>
	
		<td align="left"><a href="Admin.php?id=Announcements&cid='.$theID.'&act=delete" >Delete</a></td>
      </tr>';
}   						
echo '</tbody></table></br>
<a href="Admin.php?id=Announcements&cid=xyz&act=AddAnn" >Add Announcement</a>';	
						
					}
					
				}
				
				
				
				
			}
			
			
			
			?>
			
		</div>
            </div>

   <div class="rightrow content ">

                <div class="col-sm-2  sidenav">

                    <div class="list-group courses">
					<a href="Admin.php?id=Requests" class="list-group-item">Requests<?php
$request_count=0;
$query="Select * from GIT_User_Request";
$result=$conn->query($query);
$request_count=$result->num_rows;
if($request_count>0){
	
	echo "({$request_count})";
}

?></a>
					 <a href="Admin.php?id=Students" class="list-group-item">View Students</a>
				      <a href="Admin.php?id=Category" class="list-group-item">Category</a> 
					   <a href="Admin.php?id=Courses" class="list-group-item">Courses</a>
					     <a href="Admin.php?id=Messages" class="list-group-item">Messages</a>
						  <a href="Admin.php?id=Announcements" class="list-group-item">Announcements</a>
                    </div>
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