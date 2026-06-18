<?php
include 'config.php';
session_start();
if (isset($_FILES['fileToUpload'])) {
	$errors=array();
	$file_name=$_FILES['fileToUpload']['name'];
	$file_size=$_FILES['fileToUpload']['size'];
	$file_tmp=$_FILES['fileToUpload']['tmp_name'];
	$file_type=$_FILES['fileToUpload']['type'];
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
}//end of file upload isset
$title=mysqli_real_escape_string($conn,$_POST['post_title']);
$desc=mysqli_real_escape_string($conn,$_POST['postdesc']);
$category=mysqli_real_escape_string($conn,$_POST['category']);
$date=date("d M,Y");
$author=$_SESSION['userid'];
$sql="INSERT INTO post (title,description,category,post_date,author,post_img) VALUES ('{$title}','{$desc}',{$category},'{$date}',{$author},'{$file_name}');";
$sql .="UPDATE category SET post= post + 1 WHERE category_id={$category}";
if (mysqli_multi_query($conn,$sql)) {
	 header("location:{$hostname}/admin/post.php");
}//end of insert and update query isset
else{
	echo "<div class='alert alert-danger'>Query failed.</div>";
}
?>