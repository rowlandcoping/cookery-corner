<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$head= $path."/admin/includes/head_admin.php";
$config = $path."/config.php";
$newpass =$path."/createnew_password.php";
$resetpass = $path."/reset_password.php";
$publiclogin = $path."/publiclogin.php";

require($config);

if (isset($_POST['reset-password-submit'])){
	

$selector =$_POST['selector'];
$validator =$_POST['validator'];
$password =$_POST['pwd'];
$password_conf =$_POST['pwd_conf'];	

if (empty($password) || empty($password_conf))
{$errormess ="a password field is empty, try again";
include ($newpass);
exit();
}
if ($password != $password_conf){  $errormess= "the passwords do not match, try again";
									include ($newpass);									
									exit();}

$current_date = date("U");
$stmt=$conn->prepare("SELECT * FROM password_reset WHERE reset_selector=? AND reset_expires>=?");
$stmt->bind_param ("ss", $selector, $current_date);
$stmt->execute();
$array = $stmt ->get_result();
$result=$array->fetch_assoc();

if(!$result){ $errormess= "reset link expired, please request another one";
			include($resetpass);
			exit();
}

$token_bin = hex2bin($validator);
$token_check = password_verify($token_bin, $result['reset_token']);

if ($token_check === false) {$errormess= "reset link not valid, please request another one";
							include($resetpass);
							exit();
}elseif ($token_check===true) {
	
	$token_email = $result['reset_email'];
	
$stmt=$conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param ("s", $token_email);
$stmt->execute();
$result = $stmt ->get_result();

if (!$result) {
	$errormess= "user not found.";
	include($resetpass);
	exit();
}else{
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$stmt=$conn->prepare("UPDATE users SET password=? WHERE email=?");
$stmt->bind_param ("ss", $password_hash, $token_email);
$stmt->execute();
$stmt=$conn->prepare("DELETE FROM password_reset WHERE reset_email=?");
$stmt->bind_param ("s", $token_email);
if ($stmt->execute()===true){	$successmess= "Password updated, login to your heart's content
								<br>well, unless you already forgot it. In which case.....";
  							    include($publiclogin);
								exit();
			}else{$errormess= "Something went wrong";
				include($newpass);
				exit();
			}
}
}}
