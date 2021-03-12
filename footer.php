<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                        include 'config.php';
                        $sql="SELECT * FROM setting";
                        $result=mysqli_query($conn,$sql) or die("Query failed:Select");
                        if (mysqli_num_rows($result)>0) {
                        while ($row = mysqli_fetch_assoc($result)) { 
                   ?>
                <span><?php echo $row['footerdesc']; ?></a></span>
                <?php
                       }
                    } 
                    ?>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
