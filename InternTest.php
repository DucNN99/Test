<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="InternTest.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
  .data, td, th{  
  border: 1px solid #ddd;
  text-align: left;
}
th{
  background-color: #81F7F3;
}


.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  padding-top: 50px; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}

.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 70%;
}


.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.data {
  border-collapse: collapse;
  width: 1200px;
}

.list{
      border: 1px solid #A9F5F2;
      width: 1210px;
      margin-left: 170px;
      padding: 5px;
      margin-top: 10px;
}
th, td{
  padding: 5px;
}
a:hover{
  text-decoration: none;
  color: white;
}
.aa:hover{
    text-decoration: none;
  color: red;
}
.function{
  margin-left: 211px;
}
.hr1{
  margin-top: 1px;
  margin-left: 1px;
  width: 1200px;
  margin-left: 170px;
}
</style>
<body>

<div class="container">
        <h1>Company Information</h1><br>
        <form method="get" action="search.php">
            Company Code  : <input type="text" name="CpCode" id="CpCode" class="form-control form-control-sm"/>
            <br>
             Company Name : <input type="text" name ="CpName" id="CpName" class="form-control form-control-sm" />
            <br>
            <a href="search.php?Code=<?php $_GET['CpCode']?>&Name=<?php $_GET['CpName']?>"><button class="btn btn-success" type="submit" id="btnSearch" style="width: 100px;">Search
            </button></a>
            <br>
        </form>
</div>
<hr class="hr1">
<div class="function">
    <button class="btn btn-info" id="btnAdd" style="width: 100px;">Add</button>
    <button class="btn btn-info"  style="width: 100px;">Import</button>
    <button class="btn btn-info"  style="width: 100px;">Export</button>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2> DATABANK  |  FrontMaster  |  Create new company detail</h2>
      <form action="InternTest.php" method="post">
            Code  : <input type="text" name="Code" id="Code" autofocus="" class="form-control form-control-sm" required autofocus />
            <br>
            Name : <input type="text" name ="Name" id="Name"class="form-control form-control-sm" required />
            <br>
            Address : <input type="text" name ="Address" id="Address" class="form-control form-control-sm" required />
            <br>
            Phone : <input type="text" name ="Phone" id="Phone" class="form-control form-control-sm" required />
            <br>
            Email :<input type="text" name ="Email" id="Email" class="form-control form-control-sm" required />
            <br>
            Description :<input type="text" name ="Description" id="Description" class="form-control form-control-sm" required />
            <br>
            <button class="btn btn-info" type="submit">Save</button>
            <button class="btn btn-danger" type="cancel" onclick="javascript:window.location='InternTest.php';">Cancel</button>
            <br>
          </form>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("btnAdd");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
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

    $code="";
    $name="";
    $address="";
    $phone="";
    $email="";
    $description="";
    //insert
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(isset($_POST['Code'])){ $code=$_POST['Code']; }
      if(isset($_POST['Name'])){ $name=$_POST['Name']; }
      if(isset($_POST['Address'])){ $address=$_POST['Address']; }
      if(isset($_POST['Phone'])){ $phone=$_POST['Phone']; }
      if(isset($_POST['Email'])){ $email=$_POST['Email']; }
      if(isset($_POST['Description'])){ $description=$_POST['Description']; }

      $sql="INSERT INTO infor (Code,Name,Address,Phone,Email,Description)
      VALUES ('$code','$name','$address','$phone','$email','$description')";
      mysqli_query($conn,$sql);
    }

    ?>
    <div class="list">
  <h5>List all company using services</h5>
  <hr>
    <table class="data">
      <tr>
      <th>Code</th>
      <th>Name</th>
      <th>Address</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Description</th>
      <th>Action</th>
    </tr>
    <?php
     $sql="SELECT * FROM infor";
     $result=$conn->query($sql);
     if($result->num_rows>0){
      while($row = $result->fetch_assoc()){
        ?>
        <tr>
        <td><?php echo $row['Code']; ?></td>
        <td><a href="infor.php?Code=<?php echo $row['Code'];?>" class="aa"><?php echo $row['Name']; ?></a></td>
        <td><?php echo $row['Address']; ?></td>
        <td><?php echo $row['Phone']; ?></td>
        <td><?php echo $row['Email']; ?></td>
        <td><?php echo $row['Description']; ?></td>
        <td><a href="Delete.php?Code=<?php echo $row['Code'];?>"><button class='btn btn-danger btn-block' onclick="return confirm('Do you want to delet?')">Delete</button></a></td>
        </tr> 
      <?php
      }
    }
    //delete

    ?>
        </table>
    </div>

</body>
</html>
