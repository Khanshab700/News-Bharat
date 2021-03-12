<?php
include 'config.php';
if (empty($_FILES['new-logo']['name'])) {
	$file_name=$_POST['old_logo'];
}else{
	$errors=array();
	$file_name=$_FILES['new-logo']['name'];
	$file_size=$_FILES['new-logo']['size'];
	$file_tmp=$_FILES['new-logo']['tmp_name'];
	$file_type=$_FILES['new-logo']['type'];
	$file_ext=end(explode('.',$file_name));
	$extensions=array("jpeg","jpg","png");
	if (in_array($file_ext,$extensions) === false) {
		$errors[]="This extension file not allowed,Please choose jpg,png file";
	}
	if ($file_size > 2097152) {
		$errors[]="File size must be 2 mb or lower";
	}
	if (empty($errors) == true) {
		move_uploaded_file($file_tmp,"images/".$file_name);
	}else{
		print_r($errors);
		die();
	}
}
$webname=mysqli_real_escape_string($conn,$_POST['web_name']);
$footerdescv=$_POST['footerdesc'];
$sql="UPDATE setting SET websitename='{$webname}',footerdesc='{$footerdescv}',logo='{$file_name}'";
$result=mysqli_query($conn,$sql) or die("Query Failed!");
if ($result) {
	header("location:{$hostname}/admin/setting.php");
}else{
	echo "Query failed.";
}
?>