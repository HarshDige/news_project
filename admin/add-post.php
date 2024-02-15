<?php include "header.php"; 
    require_once "conn.php";


?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="save-post.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <!-- <option value="" disabled> Select Category</option> -->
                              <?php

                                    $sql = "SELECT * FROM `category`";    
                                    $result=mysqli_query($conn,$sql) OR die("Query Failed");

                                    if(mysqli_num_rows($result)>0)
                                    {
 
                                        while($data=mysqli_fetch_assoc($result))
                                        {
                                            echo "<option value=".$data['category_name'].">".$data['category_name']."</option>";
                                        }    
                                        
                                    }
                              ?>  
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="photo" required>
                          <label id="size-error" style="color:red; display:none;">Document Size must Be 2Mb</label>
                          <label id="photo-error" style="color:red; display:none;"></label>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
  
<?php include "footer.php"; ?>
