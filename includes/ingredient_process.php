<?php

function getPost($slug)
{
	global $conn;
	// Get single post slug
	$post_slug = $_GET['post-slug'];
    $sql = $conn->prepare("SELECT * FROM ingredients WHERE slug=?");
	$sql->bind_param("s", $post_slug);
	$sql->execute();
    $result=$sql->get_result();
	$post = $result->fetch_assoc();
	return $post;
}	

	
	
?>
