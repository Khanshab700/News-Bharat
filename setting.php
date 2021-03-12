<?php include "header.php"; ?>
<?php 
if (!$_SESSION['username']) {
    header("Location:{$hostname}/admin/");
}
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Website Settings</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
    	<?php
                   include 'config.php';
                   $sql="SELECT * FROM setting";
                   $result=mysqli_query($conn,$sql) or die("Query failed:Select");
                   if (mysqli_num_rows($result)>0) {
                   while ($row = mysqli_fetch_assoc($result)) {
                        
                ?>
        <!-- Form for show edit-->
        <form action="save-setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="exampleInputTile">Website Name</label>
                <input type="text" name="web_name"  class="form-control" id="exampleInputUsername" value="<?php echo $row['websitename']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Footer Description</label>
                <textarea name="footerdesc" class="form-control"  required rows="5">
                    <?php  echo $row['footerdesc'];?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="">LOGO</label>
                <input type="file" name="new-logo">
                <img  src="../images/<?php echo $row['logo']; ?>" height="150px">
                <input type="hidden" name="old_logo" value="<?php echo $row['logo']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php
             }
            } 
        ?>
        <!-- Form End --> 
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>