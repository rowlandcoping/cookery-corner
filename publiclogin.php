<?php ini_set('display_errors', 0);ini_set('display_startup_errors', 0);if(!isset($_SESSION)){session_start();}?>
<html>
	<head>
	<title>Cookery Corner - User Login</title>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$doctype="$path"."/includes/doctype.php";
$head = "$path"."/includes/head_publicform.php";

require_once($config);
require_once($doctype);
require_once($head);
?>
<body>
<div class="form">

<div class ="section">
			<h2><b>Log in</b></h2>
			<?php if (!empty($successmess)){echo "<hr/><h3><span style=\"color:#83f28f;\">".$successmess."</span><hr/></h3>";}
				  if (!empty($messaging)) {echo "<hr/><h3><span style=\"color:red;\">".$messaging."</span><hr/></h3>";}?>
			<form method="post" action="/login" >
			<ul class="form2">
			<li id="email2">e-mail:</li>	
			
			<li id="input"><input type="text" name="realone" placeholder="e-mail" value="<?php if (!empty($_POST['realone'])){echo $_POST['realone'];}?>"></li>
			</ul>
			<ul class="form2">
			<li id="password2">password:</li>	
			<li id="input"><input type="password" name="password" placeholder="Password"></li>
			</ul>
			<label for="If you can read this then please leave this field blank"><input id="email" type="text"  name="email" size="40"/></label>
			<p><input type="submit" class="button" name="login_btn" value="Log In" /></p> 
			
			</form>
		
			<h3>Not registered yet? <a href="/register_user.php" target="blank">Get involved!</a></h3>
			<h3>Forgot Password? <a href="/reset_password.php" target="blank">No Problem!</a></h3>
			</div>
			</div>
</body>
</html>
