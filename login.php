<?php
session_start();

 
$host="localhost";
$username="root";
$password="";
$dbname="mca_app";

if(isset($_POST['login']))
{
	$con=mysqli_connect($host,$username,$password)or die("DB connection failed");
	mysqli_select_db($con,$dbname) or die("Cannot find $dbname");
	$id=$_POST['username'];
	$password=$_POST['pass'];
	
	if($id!=' ' && $password!=' ')
	{
	$sql="select ID from login where ID='$id'";
	$result=mysqli_query($con,$sql);
	$rows=mysqli_num_rows($result);
	}
	else{
		echo"ID and Password required<br>";
	}
	if($rows==1)
		header("Location:files.html");
	else
		echo"<script type=text/javascript>alert('No data found')</script>";
	
}
	
