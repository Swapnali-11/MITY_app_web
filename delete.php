<?php
include 'upload.php';
// session_start();

//$img=$_POST['img'];
//echo"$img";
$host="localhost";
$username="root";
$password="";
$dbname="MCA_APP";
$deleteid=$_GET['delete'];

$con=mysqli_connect($host,$username,$password)or die("DB connection failed");
    mysqli_select_db($con,$dbname) or die("Cannot find $dbname");

   $que="DELETE FROM documents where id='".$deleteid."'";
   if(mysqli_query($con,$que))
   {
    echo "<script type='text/javascript'>alert('Deleted succesfully.');</script>";
    // echo "Deleted ";
    // header('Location: files.html');

   }
   else
   {
    echo "<script type='text/javascript'>alert('Could not delete.');</script>";

   }

        echo "<script> location.href='files.html'; </script>";
        exit;

   ?>