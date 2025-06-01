<?php 
	
	$host='localhost';
	$username='root';
	$pass='';
	$db='TechZone';

	$conn=mysqli_connect($host,$username,$pass,$db) ;

	if(!$conn) die("Connection refused");
 ?>