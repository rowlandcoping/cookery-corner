<?php

function getPost($slug)
{
	global $conn;
	// Get single post slug
	$post_slug = $_GET['post-slug'];
	$sql = "SELECT * FROM recipes WHERE titslug='$post_slug'";
	$result2 = mysqli_query($conn, $sql);
	// fetch query results as associative array.
	$post = mysqli_fetch_assoc($result2);
	return $post;
}	

	
	
?>
