<?php
$stmt=$conn->prepare("SELECT ID, title, slug, live, closed FROM liveblog WHERE ID=?");
$stmt ->bind_param("i", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();



echo "<h2>Update <a href=\"/liveblog/".$result['slug']."\" target=\"_blank\" rel=\"noreferrer noopener\">".$result['title']."</a></h2>";
if (!empty($updated)){echo $updated;}

//set if live or not
echo "<h3>Published Status: ";
if ($result['live']==0) {echo "<span style=\"color:orange;\"> 
					<a class=\"fa fa-toggle-off btn basic\" href=\"update_liveblog.php?publish=".$result['ID']."\"></a> Preview</span>";}
				else    {echo "<span style=\"color:green;\"> 
					<a class=\"fa fa-toggle-on btn basic\" href=\"update_liveblog.php?unpublish=".$result['ID']."\"></a> Live</span>";}

//set if open or closed for entries
echo "<br /><br />Active Status: ";					
if ($result['closed']==1) {echo "<span style=\"color:red;\"> 
					<a class=\"fa fa-toggle-off btn basic\" href=\"update_liveblog.php?open=".$result['ID']."\"></a> Closed for entries</span></h3><hr>";}
				else    {echo "<span style=\"color:green;\"> 
					<a class=\"fa fa-toggle-on btn basic\" href=\"update_liveblog.php?close=".$result['ID']."\"></a> Open for entries</span></h3><hr>";}
					

	echo "<div>
		<h3><a class=\"fa fa-pencil btn image\" href=\"update_liveblog.php?edit-basic=".$result['ID']."\"></a> Update Basic Info</h3>
	  </div>";

	echo "<div>
		<h3><a class=\"fa fa-pencil btn image\" href=\"update_liveblog.php?edit-content=".$result['ID']."\"></a> Update Content</h3>
	  </div>
	  <hr>
	

<h4><a href=\"\admin\update_liveblog.php\">Select another live blog</a>
<br /><a href=\"\admin\admin.php\">Return to Profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
exit();  

?>
