<?php 
 include 'config.php';
 $page_info= basename($_SERVER['PHP_SELF']);
 switch ($page_info) {
    case 'category.php':
      if (isset($_GET['catid'])) {
        $sql_title="SELECT * FROM category WHERE category_id={$_GET['catid']}";
        $result_title=mysqli_query($conn,$sql_title) or die("Query Failed : Category");
        $row_title=mysqli_fetch_assoc($result_title);
        $title_data=$row_title['category_name'] . " Category";
      }else{
        $title_data="Data not found.";
      }
     break;
    case 'single.php':
       if (isset($_GET['id'])) {
        $sql_title="SELECT * FROM post WHERE post_id={$_GET['id']}";
        $result_title=mysqli_query($conn,$sql_title) or die("Query Failed : POST");
        $row_title=mysqli_fetch_assoc($result_title);
        $title_data=$row_title['title'];
      }else{
        $title_data="Data not found.";
      }
      break;
   case 'author.php':
       if (isset($_GET['aid'])) {
        $sql_title="SELECT * FROM user WHERE user_id={$_GET['aid']}";
        $result_title=mysqli_query($conn,$sql_title) or die("Query Failed : USER");
        $row_title=mysqli_fetch_assoc($result_title);
        $title_data="NEWS By ".$row_title['first_name']." ".$row_title['last_name'];
      }else{
        $title_data="Data not found.";
      }
    break;
    case 'search.php':
      if (isset($_GET['search'])) {
        $title_data=$_GET['search']." ITEM SEARCH";
      }else{
        $title_data="Data not found.";
      }
      break;
     case 'index.php':
         $title_data="NEWS SITE";
      break;
     default:
       $title_data="DATA NOT FOUND ERROR 404";
     break;
 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title_data; ?></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<!-- Header -->
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<?php
                        include 'config.php';
                        $sql="SELECT * FROM setting";
                        $result=mysqli_query($conn,$sql) or die("Query failed:Select");
                        if (mysqli_num_rows($result)>0) {
                        while ($row = mysqli_fetch_assoc($result)) { 
                   ?>
                <a href="index.php" id="logo"><img height="110" width="250" src="admin/images/<?php echo $row['logo']; ?>"
                ></a>
                <?php
                       }
                    } 
                    ?>
		</div>
    <!-- Nav -->
		<div class="col-md-5">
			   <div class="home">
		        <ul>
		          <li><a href="index.php">Home</a></li>
		          <li><a href="#">About</a></li>
		          <li><a href="#">Contact us</a></li>
		        </ul>
		      </div>
		</div>
  
		<div class="col-md-3">		
		       <div class="social">
		        <ul>
		          <li><a href="index.php"  class="fa fa-facebook-square fa-2x" aria-hidden="true"></a></li>
		          <li><a href="#" class="fa fa-twitter-square fa-2x" aria-hidden="true"></a></li>
		          <li><a href="#" class="fa fa-instagram fa-2x" aria-hidden="true"></a></li>
		        </ul>
		      </div>   
	   </div>
	</div>
   </div>
	<!-- Header -->
	<!-- Menu Bar -->
		<div id="menu-bar">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-12">
		                <ul class='menu'>
		                    <?php 
                       include 'config.php';
                       if (isset($_GET['catid'])) {
                           $catid=$_GET['catid'];
                       }
                       
                       $sql="SELECT * FROM category WHERE post > 0";
                      $result=mysqli_query($conn,$sql);
                      if (mysqli_num_rows($result)>0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <?php
                    if (isset($_GET['catid'])) {
                       if ($row['category_id']==$catid) {
                           $selected="active";
                        }else{
                           $selected="";
                        } 
                    }  
                    ?>
                    <li><a class="<?php echo $selected; ?>" href='category.php?catid=<?php echo $row['category_id'];  ?>'><?php echo $row['category_name']; ?></a></li>
                    <?php 
                      }
                    }
                    ?>
		                </ul>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- /Menu Bar -->
</body>
</html>