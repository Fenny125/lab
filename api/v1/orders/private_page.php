<?php
  include_once 'DBconnector.php';
  session_start();
  
  if(!isset($_SESSION['username'])){
   header("Location: login.php");
  }

  function fetchUserApiKey()
  {
   
	$dbcon = new DBconnector();
	$user = $_SESSION['username'];
	$myquery = mysqli_query($dbcon->conn, "SELECT * FROM users WHERE username='$user'");
	$user_array = mysqli_fetch_assoc($myquery);
	$uid = $user_array['id'];
	$good = mysqli_query($dbcon->conn, "SELECT * FROM api_keys WHERE user_id = '$uid' ORDER BY `api_keys`.`id` DESC") or die(mysqli_error($dbcon->conn));
	$key =  mysqli_fetch_assoc($good);
	return $key['api_key'];

  }


?>
<!DOCTYPE html>
<html>
<head>
<title>Private page</title>
<script src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="validate.js"></script>
<script type="text/javascript" src="apikey.js"></script>
<link rel="stylesheet" type="text/css" href="validate.css">
<!--Bootstrap file-->
<!--js-->
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


<!--css-->
<link rel ="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel ="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map">
<link rel ="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel ="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css.map">
<link rel ="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
<link rel ="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css.map">
<link rel ="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
<link rel ="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css.map">

</head>
<body>
<p align ='right'><a href="logout.php">Logout</a></p>
<hr>
<h3>Here, we will create an API that will allow Users/Developer to order items from external systems</h3>
<hr>
<h4>We now put this feature of allowing users to generate an API key.Click the button to generate the API key</h4>
<button class="btn btn-primary" id="api-key-btn">Generate API key</button><br><br>
<!--This text area will hold the API key-->
<strong>Your API key:</strong>(Note that if your API key is already in use by already running apllications,generating a new key will stop the application from functioning)<br>
<textarea cols="100" row="2" id="api_key" name="api_key" readonly><?php echo fetchUserApiKey();?></textarea>

<h3>Service description:</h3>
We have a service/API that allows external applications to order food and also pull all order status by using order id.
<hr>

</body>
</html>