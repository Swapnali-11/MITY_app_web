<?php
session_start();

$img=$_GET['img'];
$host="localhost";
$username="root";
$password="";
$dbname="new_test";

$con=mysqli_connect($host,$username,$password)or die("DB connection failed");
    mysqli_select_db($con,$dbname) or die("Cannot find $dbname");
    
   $que="DELETE FROM documents where b_image='$img'";
   if(mysqli_query($con,$que))
   {
    echo "<script type='text/javascript'>alert('Deleted succesfully.');</script>";
  
   }
   else
   {
    echo "<script type='text/javascript'>alert('Could not delete.');</script>";
 
   }
   ?>