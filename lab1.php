
<?php
//include_once 'DBConnector.php';
include_once 'user.php';
$con = new DBConnector;

if (isset ($_POST['btn-save'])){
    $first_name =$_POST ['first_name'];
	$last_name =$_POST ['last_name'];
    $city =$_POST ['city_name'];

$user = new User($first_name, $last_name, $city);
$res = $user->save();

if ($res){
echo "Saved!";
}
else{
echo "An error occured!";
}
}
?>

<!DOCTYPE html>
<html>

<head> <title> PHP lab 1 </title>

</head>

<body>


<form action="post" method ="POST">
    <input type="text" name="first_name" placeholder="first_name" required/><br/>
            <input type="text" name="last_name" placeholder="last_name" required/><br/>
            <input type="text" name="city_name" placeholder="city" required/><br/>
            <button type="submit" name="btn-save">Save>SAVE</button>
 
 
 

</form>



</body>

</html>