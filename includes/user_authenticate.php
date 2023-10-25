<?php session_start();
 
$path = $_SERVER['DOCUMENT_ROOT'];
$config = $path."/config.php";
$home = $path."/index.php";
$login=$path."/publiclogin.php";

require_once($config);

if (!empty($_POST['email'])){
	echo $_POST['email'];
	exit();
}

if (empty($_POST['realone']) || empty($_POST['password'])) {
	$messaging = "Please enter username and password!";
	include($login);
	exit();
}


if ($stmt = $conn->prepare("SELECT ID, name, password, role FROM users WHERE email = ?")) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['realone']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $name, $password, $role);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		// ----- use if there is already a session.  Can work around this.
		
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['email'] = $_POST['realone'];
		$_SESSION['name'] = $name;
		$_SESSION['ID'] = $id;
		$_SESSION['role'] = $role;
		$success="<span style=\"color:#83f28f;\">Login Successful</span>";
	    include($home);
	    exit();
		
		
	} else {
		// Incorrect password
		$messaging = "Incorrect password!";
		include($login);
		exit();
	}
} else {
	// Incorrect username
	$messaging = "Are you sure that's your e-mail address?";
		include($login);
		exit();
}
}
?>
