<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                <?php
                   include 'config.php';
                   $limit=3;
                   if (isset($_GET['page'])) {
                     $page=$_GET['page'];
                   }else{
                     $page=1;
                   }
                   $offset=($page-1)*$limit;
                   if($_SESSION['userrole']=='1'){
                      $sql="SELECT * FROM post LEFT JOIN category ON category.category_id=post.category
                        LEFT JOIN user ON post.author=user.user_id ORDER BY post_id DESC LIMIT {$offset},{$limit}";
                   }elseif($_SESSION['userrole']=='0'){
                      $sql="SELECT * FROM post LEFT JOIN category ON category.category_id=post.category
                        LEFT JOIN user ON post.author=user.user_id WHERE post.author = {$_SESSION['userid']} ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                    }
                   $result=mysqli_query($conn,$sql);
                   if (mysqli_num_rows($result)>0) {
            
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                         <?php while ($row = mysqli_fetch_assoc($result)) {
                         ?>
                          <tr>
                              <td class='id'><?php echo $row['post_id']; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php if($row['role']==1){
                                echo "Admin";
                              }else{
                                echo "Normal";
                              }?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id'];?>&catid=<?php echo $row['category'];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php }//end of while ?>
                      </tbody>
                  </table>
                   <?php }//end of table show data ?>
                <?php
                     $sql1="SELECT * FROM post";
                     $result1=mysqli_query($conn,$sql1) or die("Query failed");
                     if (mysqli_num_rows($result1)>0) {
                       $total_records=mysqli_num_rows($result1);
                       $total_page=ceil($total_records / $limit);
                       echo "<ul class='pagination admin-pagination'>";
                       if ($page > 1) {
                         echo '<li><a href="post.php?page='.($page - 1).'">Pre</a></li>';
                       }
                       
                       for ($i=1; $i <=$total_page; $i++) { 
                          if ($i==$page) {
                             $active="active";
                          }else{
                              $active="";
                          }
                          echo "<li class='$active'><a href='post.php?page=$i'>$i</a></li>";
                        }
                        if ($total_page > $page) {
                          echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                        }
                         
                       echo "</ul>";
                     }
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>