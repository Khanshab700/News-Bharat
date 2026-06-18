<?php
require 'config.php';
      $catid = mysqli_real_escape_string($conn,$_POST['cat_id']);
      $catname = mysqli_real_escape_string($conn,$_POST['cat_name']);

      $sql1="UPDATE category SET category_name='{$catname}'  WHERE category_id=$catid";
      $result1=mysqli_query($conn,$sql1) or die("query failed");
      
      if ($result1==true) {
        header("Location:{$hostname}/admin/category.php");
      } 
    
?>