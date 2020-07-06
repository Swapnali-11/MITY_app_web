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
    <!-- <div class="page-wrapper bg-dark p-t-100 p-b-50" style="background-image:url('images/bg-01.jpg');"> -->




<?php
session_start();


$host="localhost";
$username="root";
$password="";
$dbname="mca_app";

$con=mysqli_connect($host,$username,$password)or die("DB connection failed");
	mysqli_select_db($con,$dbname) or die("Cannot find $dbname");
if(isset($_POST['upload']))
{
	$imgFile = $_FILES['coverimg']['name'];
 $tmp_dir = $_FILES['coverimg']['tmp_name'];
 $imgSize = $_FILES['coverimg']['size'];

//value of the forms-------------------------------------------------------
 $cname=$_POST['course_name'];
	$year=$_POST['year'];
	$type=$_POST['type'];
	$desc=$_POST['message'];




	if($cname==null || $year==null || $type==null || $desc==null )
	{

		echo"<script type='text/javascript'>alert('Please enter values....');</script>";

		// echo"value required";*
        echo"<a href='files.html'><image src=image/home.png width=50 height=50></a>";

        echo"<a href='files.html'>Click here  to go to previous page</a>";
		die;
	}

 if(!empty($imgFile))
 {

 $upload_dir = 'image/'; // upload directory

 $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

 // valid image extensions
 $valid_extensions = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions

 // rename uploading image
 $coverpic = rand(1000,1000000).".".$imgExt;

 // allow valid image file formats
 if(in_array($imgExt, $valid_extensions)){
 // Check file size '5MB'
 if($imgSize < 5000000) {
	move_uploaded_file($tmp_dir,$upload_dir.$coverpic);
 }
 else{
 $errMSG = "Sorry, your file is too large.";
 }
 }
 else{
 $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
 }

//For Database Insertion
 // if no error occured, continue ....

 if(!isset($errMSG))
 {

 /*$que = "INSERT INTO documents(b_image) VALUES('" . $coverpic . "')";*/
 $que1="INSERT INTO documents(course_name,year,d_type,ddescription,b_image)VALUES('$cname',$year,'$type','$desc','" . $coverpic . "')";

 if(mysqli_query($con,$que1))
 {
 echo "<script type='text/javascript'>alert('Posted succesfully.');</script>";
 //echo"<a href='files.html'><image src=image/home.png width=50 height=50></a>";
 //echo"Click here for previous page";
  echo "<script> location.href='files.html'; </script>";

 }
 else
 {
 echo "<script type='text/javascript'>alert('error while inserting....');</script>";
 //echo"<a href='files.html'><image src=image/home.png width=50 height=50></a>";
 //echo"Click here for previous page";
  echo "<script> location.href='files.html'; </script>";
 }

 }


 }
}
?>



<?php
if(isset($_POST['view']))
{
	$type=$_POST['type'];
	$sql="select * from documents where d_type='".$type."'";
	$result=mysqli_query($con,$sql);

	echo"<table style='margin:auto;border:5px solid black;align:center;column-width:100px;colspan:5;rowspan:5; cellspacing:30;'><tr><th>Coursename</th><th>CourseYear</th><th>Type</th><th>Description</th><th>Image</th><th>Delete</th></tr>";
	 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		 {

      echo "<tr><td>
	  {$row['course_name']} </td><td>
          {$row['year']} </td> <td>
		  {$row['d_type']} </td><td>
		  {$row['ddescription']} </td>
		  <td><a target='_blank' href='image/{$row['b_image']}'>
         <img src='image/click.png' width=50 height=50> </a></td>

        <td><input type = 'image' src='image/delete1.png' width='40' height='50' onclick='ConfirmDelete(".$row['id'].")'>
        </td></tr>";

}

   echo"</table>";

}
?> 
<script>
    function ConfirmDelete(a)
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
{
    document.location.href = "delete.php?delete="+a+"";
    // console.log("working");
      }
      else
        return false;
    }
</script>






