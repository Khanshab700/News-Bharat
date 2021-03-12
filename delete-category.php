<?php
include 'config.php';
session_start();
   if($_SESSION['userrole']=='0'){
    header("Location:{$hostname}/admin/");
   }
$userid=$_GET['id'];
$sql="DELETE FROM category WHERE category_id={$userid}";
if (mysqli_query($conn,$sql)) {
	header("Location:{$hostname}/admin/category.php");
}else{
	echo "Data can't delete";
}
mysqli_close($conn);
?>