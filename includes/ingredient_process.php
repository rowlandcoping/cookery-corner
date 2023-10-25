<?php

function getPost($slug)
{
	global $conn;
	// Get single post slug
	$post_slug = $_GET['post-slug'];
	$sql = "SELECT * FROM ingredients WHERE slug='$post_slug'";
	$result3 = mysqli_query($conn, $sql);
	// fetch query results as associative array.
	$post = mysqli_fetch_assoc($result3);
	return $post;
}	

	
	
?>
