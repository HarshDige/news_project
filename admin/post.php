<?php include "header.php"; 
      require_once "conn.php";
     
?>

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
                        <?php

                        $limit=7;    
                        if(isset($_GET['page']))
                        {
                            $page=$_GET['page'];
                        }
                        else
                        {
                            $page=1;
                        }


                        $offset=($page-1)*$limit;



                        $qut=$_SESSION['author'];
                        if($_SESSION['userrole']==1)
                        {
                            $query ="SELECT * FROM `post` ORDER BY `post_id` DESC  LIMIT $offset,$limit";
                        }      
                        else if($_SESSION['userrole']==0)
                        {
                            $query ="SELECT * FROM `post` WHERE `author`='$qut' ORDER BY `post_id` DESC  ";
                        }  

                         $result=mysqli_query($conn,$query) or die("Query Failed");

                        if(mysqli_num_rows($result) >0)
                        {
                            $sno=$offset+1;
                            while($data=mysqli_fetch_assoc($result))
                            {


                        
                        ?>
                
                          <tr>
                              <td class='id'><?php echo $sno;?></td>
                              <td><?php echo $data['title'];?></td>
                              <td><?php echo $data['category'];?></td>
                              <td><?php echo $data['post_date'];?></td>
                              <td><?php echo $data['author'];?></td>
                              <td class='edit'><a href='update-post.php?id="<?php echo $data['post_id']; ?>"'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='javascript:void(0)' id="check" onclick="checkdelete(<?php echo $data['post_id'] ?>)"><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                                $sno++;

                            }
                        }

                         ?>
                         
                      </tbody>
                  </table>
                 <!-- Delete or Not delete -->
                 <script>

                        function checkdelete(id)
                        {
                            const check=confirm("You Want To Delete Data?");
                            
                            if(check)
                            {
                               window.location.href="delete-post.php?id="+id;
                            }
                        }


                 </script>       

                  <!-- Pagination -->
                  <ul class='pagination admin-pagination'>
                      
                        <?php

                           

                            $sql="SELECT `title` FROM `post`";
                            $res =mysqli_query($conn,$sql);


                            if(mysqli_num_rows($res) >0)
                            {
                                $total_records=mysqli_num_rows($res);

                                $total_page=ceil($total_records/$limit);
                                
                                if($page > 1)
                                {
                                    echo "<li><a href='post.php?page=".($page-1)."'>Previous</a></li>";
                                }
                                for($i=1;$i<=$total_page;$i++)
                                {
                                    if($i == $page)
                                    {
                                        $active="active";
                                    }
                                    else
                                    {
                                        $active="";
                                    }
                                    echo "<li class='$active'><a href='post.php?page=".$i."'>".$i."</a></li>";
                                }
                                if($total_page>$page)
                                {
                                    echo "<li><a href='post.php?page=".($page+1)."'>Next</a></li>";
                                }

                            }

                        ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
