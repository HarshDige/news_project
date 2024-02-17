<?php include "header.php"; 
    require_once "conn.php";


    if($_SESSION["userrole"] == 1)
    {

          
       
?>

<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Website Settings</h1>
    </div>

    <?php
            $sql="SELECT * FROM `setting`";
            $res=mysqli_query($conn,$sql);

            if(mysqli_num_rows($res)>0)
            {
                  while($data=mysqli_fetch_assoc($res))
                  {
                        ?>
    <div class="col-md-offset-3 col-md-6">
          <!-- Form for show edit-->
          <form action="update-setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                
                <div class="form-group">
                      <label for="exampleInputTile">Website Name</label>
                      <input type="text" name="website_name"  class="form-control" id="exampleInputUsername" value="<?php echo $data['websitename']; ?>">
                  </div>
            <div class="form-group">
                  <label for="exampleInputPassword1">Footer Description</label>
                  <textarea name="footer" class="form-control"  required rows="5">
                              <?php echo $data['footerdesc']; ?>
                        </textarea>
                  </div>
                  
                  
                  
                  <div class="form-group">
                        <label for="">Website Logo</label>
                        <input type="file" id="new" name="new-image" >
                        
                        <img  src="./images/<?php echo $data['logo']; ?>" id="image" height="100px">
                        <input type="hidden"  name="old-image" value="<?php echo $data['logo']; ?>">
                  </div>
                  
                  
                  <input type="submit" name="savesetting" class="btn btn-primary" value="Save" />
            </form>
            <!-- Form End -->
      </div>
      <?php
      
                  }
            }
     
     
     ?>

    </div>
  </div>
</div>

<script>
               

                const image =document.getElementById("image"),
                      input  =document.getElementById("new");
                       

                input.addEventListener("change", () => {
                    image.src =URL.createObjectURL(input.files[0]);
                });
                   
               
</script>    


<?php include "footer.php"; 
        }
        else
        {
            header("Location:$host/admin/post.php");
        }
 
?>
