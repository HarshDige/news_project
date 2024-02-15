<?php include "header.php"; 
    require_once "conn.php";
    
 

    if($_SESSION["userrole"] == 1)
    {
       
    
    ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                       <?php
                             $limit = 3;
                            

                             if(isset($_GET['page']))
                             {
                                $page =$_GET['page'];
                             }
                             else
                             {
                                $page = 1;
                             }
                             $offset = ($page - 1)*$limit ;   

                               $query = "SELECT * FROM `user` ORDER BY `user_id` ASC LIMIT $offset,$limit";
                               $result = mysqli_query($conn,$query);
                               
                               if(mysqli_num_rows($result) > 0)
                               {
                                    $sno = ($offset+1);
                                    while($data=mysqli_fetch_assoc($result))
                                    {

                                 
                                     
                                     if($data['role'] == 1)
                                     {
                                        $role = "Admin";
                                     }
                                     else
                                     {
                                        $role = "Normal";
                                     }
                                 

                        ?>
                          <tr>
                              <td class='id'><?php echo $sno; ?></td>
                              <td><?php echo $data['first_name']." ".$data['last_name'] ; ?></td>
                              <td><?php echo $data['username'] ?></td>
                              <td><?php echo $role; ?></td>
                              <td class='edit'><a href="update-user.php?id=<?php echo $data['user_id']; ?>"><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a  href='javascript:void(0);' onclick="deletedata('<?php echo $data['user_id'];?>')" ><i class='fa fa-trash-o'></i></a></td>
                          </tr>

                          <?php
                                    $sno++;
                                               
                                    }
                                }
                                else
                                {
                                    echo "<h4>Query Failed</h4>";
                                }

                           

                          ?>
                      </tbody>
                  </table>

                  <?php



                    $query1 = "SELECT * FROM `user`";
                    $result1 = mysqli_query($conn, $query1) or die("query failed");


                    if (mysqli_num_rows($result1) > 0) {

                        $total_records = mysqli_num_rows($result1);
                       
                        $total_page = ceil($total_records / $limit);

      
                 
                    echo "<ul class='pagination admin-pagination'>";

                    
                    if($page > 1)
                    {
                    echo "<li><a href='users.php?page=".($page-1)."'>Previous</a></li>";
                    }
                    for($i =1;$i <= $total_page ;$i++)
                    {
                        if($i == $page)
                        {
                            $active = "active";
                        }
                        else
                        {
                            $active = "";
                        }
                        echo "<li class='$active'><a href='$host/admin/users.php?page=$i'>$i</a></li>";

                    }
                    if($total_page > $page)
                    {
                        echo "<li><a href='users.php?page=".($page+1)."'>Next</a></li>";
                    }
                        echo "</ul>";


                     
                   

               }


                ?>  
              </div>
          </div>
      </div>
  </div>


  <script>
   

    function deletedata(id)
    {
         $confirm =confirm("Do You Want To Delete Data?");

        if($confirm)
        {
            window.location.href="delete-user.php?id="+id;
        }
    }
  </script>
<?php include "footer.php";
    }
     else
        {
            header("Location:$host/admin/post.php");
        }
   

?>
