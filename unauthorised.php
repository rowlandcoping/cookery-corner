<?php session_start();?>
<html>

<body>

<p>Hello 

<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	echo "faithful user!";
}else {
	echo $_SESSION['name'] . '!';
}

?>

<p>You are not authorised to access this section of the site... yet!</p>

<p>If you are serious about submitting content please contact Rowland <a href="/general_contact.php">here</a> with your recipe or feature ideas 
- to become a publisher on the site that's the first step, we'll take a look and if we like what we see we'll take it from there, because we always need more content!</p>

<p><a href="/index.php">Home</a></p>


</body>




</html>
