<?php
$stmt=$conn->prepare("SELECT ID, title, slug, live, image1, heading1, image2, heading2, image3, heading3, image4, heading4, image5, heading5,
					 image6, heading6, image7, heading7, image8, heading8 FROM reviews WHERE ID=?");
$stmt ->bind_param("i", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();



echo "<h2>Update <a href=\"/reviews/".$result['slug']."\" target=\"_blank\" rel=\"noreferrer noopener\">".$result['title']."</a></h2>";
if (!empty($updated)){echo $updated;}
echo "<h3>Current Status: ";
if ($result['live']==0) {echo "<span style=\"color:orange;\"> 
					<a class=\"fa fa-toggle-off btn basic\" href=\"update_review.php?publish=".$result['ID']."\"></a> Preview</span></h3><hr>";}
				else    {echo "<span style=\"color:green;\"> 
					<a class=\"fa fa-toggle-on btn basic\" href=\"update_review.php?unpublish=".$result['ID']."\"></a> Live</span></h3><hr>";}



	echo "<div>
		<h3><a class=\"fa fa-pencil btn image\" href=\"update_review.php?edit-basic=".$result['ID']."\"></a> Update Basic Info</h3>
	  </div>";

	echo "<div>
		<h3><a class=\"fa fa-pencil btn image\" href=\"update_review.php?edit-intro=".$result['ID']."\"></a> Update Introduction</h3>
	  </div>
	  <hr>";

	if (!empty($result['heading1'])) {
	echo"<div>
		<h3><a class=\"fa fa-pencil btn basic\" href=\"update_review.php?edit-review1=".$result['ID']."\"></a> | \"".$result['heading1']."\"
	</h3></div>";
	}
	
	if (!empty($result['heading2'])) {
	echo"<div>
		<h3><a class=\"fa fa-pencil btn basic\" href=\"update_review.php?edit-review2=".$result['ID']."\"></a> | \"".$result['heading2']."\"
	</h3></div>";
	}
	
	if (!empty($result['heading3'])) {
	echo"<div>
	<h3><a class=\"fa fa-pencil btn basic\" href=\"update_review.php?edit-review3=".$result['ID']."\"></a> | \"".$result['heading3']."\"
	</h3></div>";
	}
	
	if (!empty($result['heading4'])) {
	echo"<div>
	<h3><a class=\"fa fa-trash btn basic\" href=\"update_review.php?delete-review4=".$result['ID']." \"></a> | 
	<a class=\"fa fa-pencil btn basic\" href=\"update_review.php?edit-review4=".$result['ID']."\"></a> | \"".$result['heading4']."\"
	</h3></div>";
	}else{if (!empty($result['heading3'])){
	echo"<div>
		<h3><a class=\"fa fa-plus btn basic\" href=\"update_review.php?edit-review4=".$result['ID']."\"></a> | Add an Additional Segment</h3>
		</div>";
	}}
	
	if (!empty($result['heading5'])) {
	echo"<div>
		<h3><a class=\"fa fa-trash btn basic\" href=\"update_review.php?delete-review5=".$result['ID']." \"></a> | 
	<a class=\"fa fa-pencil btn basic\" href=\"update_review.php?edit-review5=".$result['ID']."\"></a> | \"".$result['heading5']."\"
	</h3></div>";
	}else{if (!empty($result['heading4'])){
	echo"<div>
		<h3><a class=\"fa fa-plus btn basic\" href=\"update_review.php?edit-review5=".$result['ID']."\"></a> | Add an Additional Segment</h3>
		</div>";
	}}
	
	if (!empty($result['heading6'])) {
	echo"<div>
		<h3><a class=\"fa fa-trash btn basic\" href=\"update_review.php?delete-review6=".$result['ID']." \"></a> | 
	<a class=\"fa fa-pencil btn basic\" href=\"update_review.php?edit-review6=".$result['ID']."\"></a> | \"".$result['heading6']."\"
	</h3></div>";
	}else{if (!empty($result['heading5'])){
	echo"<div>
		<h3><a class=\"fa fa-plus btn basic\" href=\"update_review.php?edit-review6=".$result['ID']."\"></a> | Add an Additional Segment</h3>
		</div>";
	}}
	
	if (!empty($result['heading7'])) {
	echo"<div>
		<h3><a class=\"fa fa-trash btn basic\" href=\"update_review.php?delete-review7=".$result['ID']." \"></a> | 
	<a class=\"fa fa-pencil btn basic\" href=\"update_review.php?edit-review7=".$result['ID']."\"></a> | \"".$result['heading7']."\"
	</h3></div>";
	}else{if (!empty($result['heading6'])){
	echo"<div>
		<h3><a class=\"fa fa-trash btn basic\" href=\"update_review.php?delete-review7=".$result['ID']." \"></a>
		<a class=\"fa fa-plus btn basic\" href=\"update_review.php?edit-review7=".$result['ID']."\"></a> | Add an Additional Segment</h3>
		</div>";
	}}
	
	if (!empty($result['heading8'])) {
	echo"<div>
		<h3><a class=\"fa fa-trash btn basic\" href=\"update_review.php?delete-review8=".$result['ID']." \"></a> | 
	<a class=\"fa fa-pencil btn basic\" href=\"update_review.php?edit-review8=".$result['ID']."\"></a> | \"".$result['heading8']."\"
	</h3></div>";
	}else{if (!empty($result['heading7'])){
	echo"<div>
		<h3><a class=\"fa fa-plus btn basic\" href=\"update_review.php?edit-review8=".$result['ID']."\"></a> | Add an Additional Segment</h3>
		</div>";
	}}
	
	echo "<hr>
		<div>
		<h3><a class=\"fa fa-pencil btn image\" href=\"update_review.php?edit-conclusion=".$result['ID']."\"></a> Update Conclusion</h3>	
		</div>
		<hr>
	

<h4><a href=\"\admin\update_review.php\">Select another review</a>
<br /><a href=\"\admin\admin.php\">Return to Profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
exit();  

?>
