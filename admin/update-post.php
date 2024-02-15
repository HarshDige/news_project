<?php include "header.php"; 
    require_once "conn.php";


    if(isset($_GET['id']))
    {
    
     $id=$_GET['id'];   
     $sql ="SELECT * FROM `post` WHERE `post_id`=$id";
     $res = mysqli_query($conn,$sql);   
     
        if(mysqli_num_rows($res)>0)
        {
            $data=mysqli_fetch_assoc($res);
            
            

          
       
?>

<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $data['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $data['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                   <?php echo $data['description'];?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select  class="form-control" name="category" id="category">
                      <?php
                    
                           $sql1="SELECT `category_name` FROM `category`";
                           $res1=mysqli_query($conn,$sql1) or die("Query Failed");
                           
                           if(mysqli_num_rows($res1)>0)
                           {

                               while($cat=mysqli_fetch_assoc($res1))
                               {

                                    if($cat['category_name'] == $data['category'])
                                    {
                                        $selected="selected";
                                    }
                                    else
                                    {
                                        $selected="";
                                    }
                                   
                                           echo "<option $selected value=".$cat['category_name'].">".$cat['category_name']."</option>";
                                    
                                
                               }

                           }

                    ?>
                </select>
            </div>
            <select  class="form-control" name="old-category" id="category1" style="display:none;">
                      <?php

                            $sql2="SELECT `category_name` FROM `category`";
                            $res2=mysqli_query($conn,$sql2) or die("Query Failed");

                                if(mysqli_num_rows($res2)>0)
                                {

                                    while($cat=mysqli_fetch_assoc($res2))
                                    {

                                        if($cat['category_name'] == $data['category'])
                                        {
                                            $selected="selected";
                                        }
                                        else
                                        {
                                            $selected="";
                                        }
                                        
                                                echo "<option $selected value=".$cat['category_name'].">".$cat['category_name']."</option>";
                                        
                                    
                                    }

                                }
                    ?>
             </select>
            <!-- SELECT -->
            <script>
                    document.getElementById("category").value="<?php echo $data['post']; ?>";

             </script>   
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" id="new" name="new-image" >
                
                <img  src="./upload/<?php echo $data['post_img']; ?>" id="image" height="150px">
                <input type="hidden"  name="old-image" value="<?php echo  $data['post_img']; ?>">
            </div>
            
            
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>

<script>
               

                const image =document.getElementById("image"),
                      input  =document.getElementById("new");
                       

                input.addEventListener("change", () => {
                    image.src = URL.createObjectURL(input.files[0]);
                });
                   
               
</script>    


<?php include "footer.php"; 
    
        }   
    }

?>
