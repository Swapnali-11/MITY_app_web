<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Upload</title>

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Main CSS-->
    <link href="css/upload.css" rel="stylesheet" media="all">
	<link rel="stylesheet" type="text/css" href="css/file.css">
</head>

<body>
    <div class="page-wrapper bg-dark p-t-100 p-b-50" style="background-image:url('images/bg-01.jpg');">




<?php
session_start();

 
$host="localhost";
$username="root";
$password="";
$dbname="Teacher_Login";

$con=mysqli_connect($host,$username,$password)or die("DB connection failed");
	mysqli_select_db($con,$dbname) or die("Cannot find $dbname");
if(isset($_POST['upload']))
{
	
	$cname=$_POST['course_name'];
	$year=$_POST['year'];
	$type=$_POST['type'];
	$desc=$_POST['message'];
	$file=$_POST['file'];
	
	
	if($cname==null)
		echo"value required";

	$sql="insert into documents(course_name,year,type,description,file)values('$cname',$year,'$type','$desc','$file')";
	if(mysqli_query($con,$sql))
	{
echo '<script type="text/javascript">

          window.onload = function () { alert("Record inserted successfully"); }

</script>';
	}
	else
	{
		echo'<script type="text/javascript">

          window.onload = function () { alert("Record not inserted"); }

</script>';
	}
		}
if(isset($_POST['view']))
{
	$type=$_POST['type'];
	$sql="select * from documents where type='$type'";
	$result=mysqli_query($con,$sql);
	
	echo"<table border=5 class='center'><tr><th>ID</th><th>Coursename</th><th>CourseYear</th><th>Type</th><th>Description</th><th>Image</th></tr>";
	 while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
		 {
      echo "<tr><td>{$row['id']}  </td><br><td> 
	  {$row['course_name']} </td><br><td> 
          {$row['year']} </td><br> <td>
		  {$row['type']} </td><br><td> 
          {$row['description']} </td><br> ";
		  echo "<td><img src= {$row['file']}width='175' height='200' /></td></tr>";
		  
		  
		  
   }
   echo"</table>";
 
   
}
?>
</div>
</body>

