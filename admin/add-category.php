<?php include "header.php"; 
        require_once "conn.php";

    
        if($_SESSION["userrole"] == 1)
        {
              


        if(isset($_POST['save']))
        {

            $category= mysqli_real_escape_string($conn,$_POST['cat']);
           
            $sql = "SELECT * FROM `category` WHERE `category_name`='$category'";
            $res = mysqli_query($conn,$sql) or die("Query Failed");

            if(mysqli_num_rows($res)>0)
            {
                echo "<h4 style='color:red;'>User Already Exeits</h4>";
            }
            else
            {
                $query = "INSERT INTO `category`(`category_name`) VALUES('$category')" ;
                $result = mysqli_query($conn,$query);
                if($result)
                {
                    header("Location:$host/admin/category.php");
                }
                else
                {
                    echo "Error";
                }
            }
        }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->

                  <form action="<?php  $_SERVER['PHP_SELF'];?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>

                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; 

}
else
   {
       header("Location:$host/admin/post.php");
   }

?>
