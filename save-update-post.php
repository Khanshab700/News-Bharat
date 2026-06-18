<?php
include 'config.php';
if (empty($_FILES['new-image']['name'])) {
	$file_name=$_POST['old_image'];
}else{
	$errors=array();
	$file_name=$_FILES['new-image']['name'];
	$file_size=$_FILES['new-image']['size'];
	$file_tmp=$_FILES['new-image']['tmp_name'];
	$file_type=$_FILES['new-image']['type'];
	$file_ext=end(explode('.',$file_name));
	$extensions=array("jpeg","jpg","png");
	if (in_array($file_ext,$extensions) === false) {
		$errors[]="This extension file not allowed,Please choose jpg,png file";
	}
	if ($file_size > 2097152) {
		$errors[]="File size must be 2 mb or lower";
	}
	if (empty($errors) == true) {
		move_uploaded_file($file_tmp,"upload/".$file_name);
	}else{
		print_r($errors);
		die();
	}
}
$post_id=mysqli_real_escape_string($conn,$_POST['post_id']);
$post_title=mysqli_real_escape_string($conn,$_POST['post_title']);
$postdesc=mysqli_real_escape_string($conn,$_POST['postdesc']);
$category=mysqli_real_escape_string($conn,$_POST['category']);
$sql="UPDATE post SET title='{$post_title}',description='{$postdesc}',category={$category},post_img='{$file_name}' WHERE post_id=$post_id";
$result=mysqli_query($conn,$sql) or die("Query Failed!");
if ($result) {
	header("location:{$hostname}/admin/post.php");
}else{
	echo "Query failed.";
}
?>