<?php
    include "Crud.php";
	include "authenticator.php";
	include_once "DBConnector.php"; 

	
	class user implements Crud, Authenticator{
		
		private $user_id;
		private $first_name;
		private $last_name;
	    private $city_name;
		
		private $username;
		private $password;
		
		function __construct($first_name, $last_name, $city_name, $username, $password) {
			$this->first_name =  $first_name;
			$this->last_name  =  $last_name;
			$this->city_name  =  $city_name;
			$this->username   =  $username;
			$this->password   =  $password;
		}

		
		    public function setuserId($user_id){
			$this->user_id = $user_id;
		    }
		
			public function getuserId(){
			return $this->$user_id;
			}
			
	        public function save() {
			$con = new DBConnector();
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			$uname = $this->username;
			$this->hashPassword();
			$pass =$this->password;
			$res = mysqli_query($con->conn, "INSERT INTO user(first_name, last_name, user_city, username, password) VALUES('$fn','$ln','$city', '$uname', '$pass')") or die("Error : " .mysqli_error($con->conn));
			$con->closeDatabase();
			return $res;
		}
		
	public function readAll(){
            $con = new DBConnector();
			$res = mysqli_query($con->conn, "SELECT * FROM users");

			if (mysqli_num_rows($res) > 0) {
				while ($row = mysqli_fetch_assoc($res)) {
					echo " " .$row['id']. " " .$row['first_name']. " " .$row['last_name']. " " .$row['user_city']. "<br>";
				}
			}
			else {
				echo "There are no records in the database";
			}
			$con->closeDatabase();
	}
	  public function readUnique(){
		return null;
	}
	public function search(){
		return null;
	}
	public function update(){
		return null;
	}
	public function removeOne(){
		return null;
	
	}
	public function removeAll(){
		return null;
	}
	public function validateForm(){
		$fn=$this->first_name;
		$ln=$this->last_name;
		$city=$this->city_name;
		if($fn == "" || $ln == "" || $city == ""){
			return false;
		}
		return true;
	}
	public function createFormerrorSessions(){
		session_start();
		$_SESSION['form_errors'] = "All fields are required";
	}
	
	public static function create(){
		$instance = new self();
		return $instance;
	}
	public function setUsername($username){
		$this->username=$username;
    }
	public function getUsername(){
		return $this->username;
    }
	public function setPassword($password){
		$this->password=$password;
    }
	public function getPassword(){
		return $this->password;
    }
	public function hashPassword(){
		$this->password=password_hash($this->password,PASSWORD_DEFAULT);
	}
	public function isPasswordCorrect(){
		$con = new DBConnector;
		$found = false;
		$res = mysqli_query ("SELECT * FROM user") or die ("Error" . mysqli_error());
		  
		  while($row=mysqli_fetch_array($res)){
			  if(password_verify($this->getPassword(), $row['password'])&& $this->getUsername()==$row['username']){
				  $found = true;
			  }
		  }
		  $con->closeDatabase();
		  return $found;
	}
	public function login(){
		if ($this->isPasswordCorrect()){
			header("Location:private_page.php");
		}
	}
	public function createUserSession(){
		session_start();
		$_SESSION['username'] = $this->getUsername();
	}
	public function logout(){
		session_start();
		unset($_SESSION['username']);
		session_destroy();
		header("Location:lab1.php");
	}
	}






?>
