<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  	h1{
	text-transform: uppercase;
	text-align: center;
}
.container{
	padding-top: 80px;
	width: 800px;
}



  </style>
</head>
<body>
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
?>

<script type="text/javascript">
	function Back() {
		window.location="InternTest.php";
	}
</script>

<?php
	if(isset($_GET['CpCode']) || isset($_GET['CpName'])){//
		$search_code=$_GET['CpCode'];
		$search_name=$_GET['CpName'];
		$sql="SELECT*FROM infor WHERE '$search_code'=Code OR '$search_name'=Name";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){//
			while($row = mysqli_fetch_assoc($result)) {//
   				echo "
   	<div class='container'>
   	<table class='table table-condensed'>
	<tr>
	<td colspan='2'><h1><b>INFORMATION OF ".$row['Name']."</b></h1></td>
	</tr>
	<tr>
		<td>Code : </td>
		<td>".$row['Code']."</td>
	</tr>
	<tr>
		<td>Name : </td>
		<td>".$row['Name']."</td>
	</tr>
	<tr>
		<td>Address : </td>
		<td>".$row['Address']."</td>
	</tr>
	<tr>
		<td>Phone : </td>
		<td>".$row['Phone']."</td>
	</tr>
	<tr>
		<td>Email : </td>
		<td>".$row['Email']."</td>
	</tr>
	<tr>
		<td>Description : </td>
		<td>".$row['Description']."</td>
	</tr>
	<tr>
	<td colspan='2'><button class='btn btn-danger btn-block' onclick='return Back()'>Back</button></td>
	</tr>
</table>
</div>";
	}	
	}
	else{
		header("location:errorpage.php");
	// echo "<h2>Company name is ".$_GET['CpName']."does not exits or 
	// 		the company code you entered is incorrect</h2>";
}

}

?>
</body>
</html>