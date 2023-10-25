<?php session_start();


$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/config.php";
require_once($path);

/*
$name = "";
$email    = "";
$errors = array();

function esc(String $value){
	// bring the global db connect object into function
	global $conn;
	// remove empty space sorrounding string
	$val = trim($value); 
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}

if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$name = esc($_POST['name']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);
		$food_pro = esc($_POST['food_pro']);
		$profile_pic = esc($_POST['profile_pic']); //add image sanitisation code above.

		// form validation: ensure that the form is correctly filled
		if (empty($name)) {  echo "You must have an identity";}
		if (empty($email)) { echo "Your e-mail is your passport so we kind of need it."; }
		if (empty($password_1)) { echo "No password entered. You didn't expect that to work?"; }
		if ($password_1 != $password_2) { echo "passwords do not match; \"I wash myself with a mop on a stick\"";}

		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		//$user_check_query = "SELECT * FROM users WHERE name='$name' 
								//OR email='$email' LIMIT 1";

		//$result = mysqli_query($user_check_query);
		//$user = mysqli_fetch_assoc($result);

		//if ($user) { // if user exists
			//if ($name['name'] === $name) {
			  //array_push($errors, "Username already exists");
			//}//
			//if ($email['email'] === $email) {
			  //array_push($errors, "Email already exists");
			//}
		//}
		// register user if there are no errors in the form
		//if (count($errors) == 0) {
			//encrypt the password before saving in the database
		*/	
            $stmt = $conn->prepare ("INSERT INTO users (name, food_pro, profile_pic, email, password, role) 
					  VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssss", $name, $food_pro, $profile_pic, $email, $password, $role);
			$name = $_POST['name']; 
			$food_pro = $_POST['food_pro'];
			$profile_pic = $_POST['profile_pic']; //add image sanitisation code above.
			$email = $_POST['email'];
			$password = $_POST['password_1'];
			$role = "admin";
			
	      if ($stmt->execute() === TRUE) {
					echo "<p>User Added</p>";
					} else {
					echo "<p>Something was bound to go wrong</p>" . $conn->error;
					}  		  
		
?>
