<?php session_start();
// Connection details
$path = $_SERVER['DOCUMENT_ROOT'];
$config = $path."/config.php";
require_once($config);


$name = "";
$email    = "";
$errors = array();

function makeSlug(String $string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

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

		// form validation: ensure that the form is correctly filled
		if (empty($name)) {  echo "You must have an identity
							<p><a href=\"/admin/admin.php\">Admin Home</a>
							<br><a href=\"/admin/create_user.php\">Try Again</a></p>";
							;exit();}
		
		
		if (empty($email)) { echo "Your e-mail is your passport so we kind of need it.
									<p><a href=\"/admin/admin.php\">Admin Home</a>
							<br><a href=\"/admin/create_user.php\">Try Again</a></p>";
							exit();}
		if (empty($password_1)) { echo "No password entered. You didn't expect that to work? 
										<p><a href=\"/admin/admin.php\">Admin Home</a>
							<br><a href=\"/admin/create_user.php\">Try Again</a></p>";
							exit();}
		if ($password_1 != $password_2) { echo "Passwords do not match; <br>\"I wash myself with a mop on a stick\"
							<p><a href=\"/admin/admin.php\">Admin Home</a>
							<br><a href=\"/admin/create_user.php\">Try Again</a></p>";
							exit();}

		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM users WHERE name='$name' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

	if ($user) { // if user exists
		if (esc($user['name']) === $name) {
			 echo "Username already exists
			 <p><a href=\"/admin/admin.php\">Admin Home</a>
			<br><a href=\"/admin/create_user.php\">Try Again</a></p>";
			 exit();
			}
			if (esc($user['email']) === $email) {
			  echo "Email already exists
			  <p><a href=\"/admin/admin.php\">Admin Home</a>
			<br><a href=\"/admin/create_user.php\">Try Again</a></p>";
			exit();
			}
		}
		//register user if there are no errors in the form
		if (count($errors) == 0) {
			//encrypt the password before saving in the database
		
		


//get data into database

if(!empty($_FILES["profile_pic"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["profile_pic"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        // Allow certain file formats 
       
        $allowTypes = array('jpg','png','jpeg','gif', 'JPG', 'JPEG', 'GIF', 'PNG', 'bmp', 'BMP'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['profile_pic']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image));
        }else{echo "<p>invalid image format, user not added</p>
			<p><a href=\"/admin/admin.php\">Admin Home</a>
			<br><a href=\"/admin/create_user.php\">Try Again</a></p>";
			exit ();
			}
	}else{$imgContent= "";}
	
if(!empty($_POST['food_pro'])) {
		$food_pro = $_POST['food_pro'];
	}else{$food_pro="";
	}
if(!empty($_POST['profile'])) {
		$profile = $_POST['profile'];
	}else{$profile="";
	}


	$stmt = $conn->prepare("INSERT into users(name, slug, food_pro, profile, profile_pic, email, password, role) VALUES (?,?,?,?,'$imgContent',?,?,?)");
  	$stmt->bind_param("sssssss", $name, $slug, $pro, $profile, $email, $password, $role);
  	$name = $_POST['name'];
  	$slug = makeSlug($name);
  	$pro = "$food_pro";
	$email = $_POST['email'];
	$password=password_hash($_POST['password_1'], PASSWORD_DEFAULT);
	$role='admin';
	

	
	
	
	
	if ($stmt->execute() === TRUE) {
					echo "<p>New User added";
					} else {
					echo "<p>Error Adding User" . $conn->error;
					}

}

/*else{echo"<p><a href=\"/admin/admin.php\">Admin Home</a>
 <br><a href=\"/admin/create_user.php\">Why not try filling out the form again properly -practice makes perfect!</a></p>";
		exit();
	}*/


}
 

?>
<p><a href="/admin/admin.php">Admin Home</a></p>
 <p><a href="/admin/create_user.php">Add another user</a></p>
