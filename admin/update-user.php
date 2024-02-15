<?php include "header.php"; 
     require_once "conn.php";

     if($_SESSION["userrole"] == 1)
     {
       
  



     if(isset($_POST['submit']))
     {



        $uid= mysqli_real_escape_string($conn,$_POST['userid']);
        $fname= mysqli_real_escape_string($conn,$_POST['f_name']);
        $lname= mysqli_real_escape_string($conn,$_POST['l_name']);
        $user= mysqli_real_escape_string($conn,$_POST['username']);
        // $pass= mysqli_real_escape_string($conn,md5($_POST['password']));
        $role= mysqli_real_escape_string($conn,$_POST['role']);

        // echo $uid;

        $query1 = "UPDATE `user` SET `first_name`='$fname',`last_name`='$lname',`username`='$user',`role`='$role'  WHERE `user_id`='$uid' ";
        $updateres = mysqli_query($conn,$query1);


        if($updateres)
        {
                header("Location:$host/admin/users.php");
        }
        else
        {
            echo "Error";
        }
    
     }

     

        if(isset($_GET['id']))
        {
                $id= $_GET['id'];

                // echo $id;

                $query = "SELECT * FROM `user` WHERE `user_id`='$id' ";
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0)
                {

                   $data=mysqli_fetch_assoc($result);


                    $role;

                    if($data['role'] == 1)
                    {
                        $role="1";
                    }
                    else
                    {
                        $role="0";
                    }
      
      
     
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="userid"  class="form-control" value="<?php echo $data['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $data['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $data['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" placeholder="" required>
                      </div>
                      
                    <!-- <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value="<?php  $data['password'] ?>" class="form-control" placeholder="Password" required>
                    </div> -->
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" id="role" value="">
                              <option value="0" >normal User</option>
                              <option value="1" checked>Admin</option>
                          </select>

                          <script>
                                document.getElementById("role").value = "<?php echo $data['role'] ?>";
                          </script>  
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; 
    

                }   
         }    


        }
        else
           {
               header("Location:$host/admin/post.php");
           }
        
    
?>
