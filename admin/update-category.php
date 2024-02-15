<?php include "header.php"; 
        require_once "conn.php";
     
    if($_SESSION["userrole"] == 1)
    {
         

        // Update form
        if(isset($_POST['update']))
        {
            $catid=mysqli_real_escape_string($conn,$_POST['cat_id']);
            $cname=mysqli_real_escape_string($conn,$_POST['cat_name']);


            $uquery="UPDATE `category` SET `category_name`='$cname' WHERE `category_id`='$catid'";
            $uresult=mysqli_query($conn,$uquery);

            if($uresult)
            {
                header("Location:".$host."/admin/category.php");
            }
            else
            {
                echo "Error";
            }

        }


        
        //display value in form
        if(isset($_GET['id']))
        {
          
            $cid=$_GET['id'];


            $query="SELECT `category_name` FROM `category` WHERE `category_id`= $cid ";
            $result=mysqli_query($conn,$query);

            if(mysqli_num_rows($result)>0)
            {
                $data=mysqli_fetch_assoc($result);



?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $cid; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $data['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php
                }
         }

?>
<?php include "footer.php"; 

}
else
   {
       header("Location:$host/admin/post.php");
   }

?>
