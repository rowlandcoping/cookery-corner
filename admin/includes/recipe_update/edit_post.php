<?php
if (empty($post_id)){$post_id=$recipe_ID;}
$stmt=$conn->prepare("SELECT ID, title, titslug, live FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();


if (isset($_GET['user-id'])) {
//approval code	
	$user_ID=$_GET['user-id'];
echo "<h2>Approve <a href=\"/recipe/".$result['titslug']."\" target=\"_blank\" rel=\"noreferrer noopener\">".$result['title']."</a></h2>";
if (!empty($updated)){echo "<h3><span style=\"color:red\">".$updated."</span></h3>";}


	echo "<h3><span style=\"color:red;\"> 
	<a href=\"update_recipe.php?reject-recipe=".$result['ID']."&user-id=".$user_ID."\">Reject Recipe</span></h3></span></a>";
	if (!empty($form_ID)){include ($rejectrecipe);}

	
echo "<h3>Current Status: ";
if ($result['live']==0) {echo "<span style=\"color:orange;\"> 
					<a class=\"fa fa-toggle-off btn basic\" href=\"update_recipe.php?publish=".$result['ID']."&user-id=".$user_ID."\"></a> Preview</span></h3>";}
				else    {echo "<span style=\"color:green;\"> 
					<a class=\"fa fa-toggle-on btn basic\" href=\"update_recipe.php?unpublish=".$result['ID']."&user-id=".$user_ID."\"></a> Live</span></h3>";}
}else{
	
//non-approval code	
echo "<h2>Update <a href=\"/recipe/".$result['titslug']."\" target=\"_blank\" rel=\"noreferrer noopener\">".$result['title']."</a></h2>";
if (!empty($updated)){echo "<h3><span style=\"color:red\">".$updated."</span></h3>";}

	
echo "<h3>Current Status: ";
if ($result['live']==0) {echo "<span style=\"color:orange;\"> 
					<a class=\"fa fa-toggle-off btn basic\" href=\"update_recipe.php?publish=".$result['ID']."\"></a> Preview</span></h3>";}
				else    {echo "<span style=\"color:green;\"> 
					<a class=\"fa fa-toggle-on btn basic\" href=\"update_recipe.php?unpublish=".$result['ID']."\"></a> Live</span></h3>";}
}
	


echo "<table>
		<tr><td><a class=\"fa fa-pencil btn basic\" href=\"update_recipe.php?edit-basic=".$result['ID']."\" target=\"_blank\"></a></td>
		<td><h3>Update Basic Info</h3></td></tr>
	  <tr><td><a class=\"fa fa-pencil btn image\" href=\"update_recipe.php?edit-image=".$result['ID']."\" target=\"_blank\"></a></td>
	  <td><h3>Update Image</h3></td></tr>
	  <tr><td><a class=\"fa fa-pencil btn ingredients\" href=\"update_recipe.php?edit-ingredients=".$result['ID']."\" target=\"_blank\"></a></td>
	  <td><h3>Update Ingredients</h3></td></tr>
	  <tr><td><a class=\"fa fa-pencil btn content\" href=\"update_recipe.php?edit-content=".$result['ID']."\" target=\"_blank\"></a></td>
	  <td><h3>Update Content</h3></td></tr>
	  </table>";

if (isset($_GET['user-id'])) {$user_ID=$_GET['user-id'];}
if (!empty($user_ID)) {	  
echo "<h4><a href=\"\admin\update_recipe.php?user-id=".$user_ID."\">Approve another recipe</a>";
}else{echo "<h4><a href=\"\admin\update_recipe.php\">Select another recipe</a>";}
echo "<br /><a href=\"/admin/admin.php\">Return to profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
exit();  

?>
