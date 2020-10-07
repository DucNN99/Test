<?php
	$hostname = 'localhost:3306';
    $username = 'root';
    $password = '';
    $dbname = "company";
    $conn = mysqli_connect($hostname, $username, $password,$dbname);
    if (!$conn) {
    die('Không thể kết nối: ' . mysqli_error($conn));
    exit();
    }

        if (isset($_GET['Code'])) {
      $remove=$_GET['Code'];
      $sql = "DELETE FROM infor WHERE Code = '$remove'"; 
      if(mysqli_query($conn,$sql)==true){
      	header("location:InternTest.php");
      }        
    }
?>