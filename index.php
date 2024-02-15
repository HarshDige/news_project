<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">

                        <?php    require_once "conn.php";

                                $limit=8;

                                if(isset($_GET['page']))
                                {
                                    $page=$_GET['page'];
                                }
                                else
                                {
                                    $page=1;
                                }



                                $offset=($page-1)*$limit;

                                $query="SELECT * FROM `post`  ORDER BY `post_id` DESC LIMIT $offset,$limit";
                                $result=mysqli_query($conn,$query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($data = mysqli_fetch_assoc($result))
                                    {

                                        $auth=explode(' ',$data['author']);
                                        
                        ?>
                        <div class="post-content"> 
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $data['post_id']; ?>"><img src="admin/upload/<?php echo $data['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $data['post_id']; ?>'><?php echo $data['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cat=<?php echo $data['category']; ?>'><?php echo $data['category']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?author=<?php echo  $auth[0].$auth[1]; ?>'><?php echo $data['author']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $data['post_date']; ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                                <?php echo substr($data['description'],0,200)."...."; ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $data['post_id']; ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php    
                                    
                                    }
                                }


                        ?>
                       
                       <!-- Pagination Start -->
                       <ul class='pagination'>        
                         <?php
                                $sql="SELECT `title` FROM `post`";
                                $res=mysqli_query($conn,$sql);


                                if(mysqli_num_rows($res)>0)
                                {
                                   
                                    $total_records=mysqli_num_rows($res);

                                    $total_page=ceil($total_records/$limit);

                                    if($page > 1)
                                    {
                                            echo "<li><a href='index.php?page=".($page-1)."'>Previous</a></li>";
                                    }
                                    for($i=1;$i <=$total_page;$i++) 
                                    {
                                        if($page == $i)
                                        {
                                            $active="active";
                                        }
                                        else
                                        {
                                            $active="";
                                        }
                                              echo  "<li class='$active'><a href='index.php?page=".$i."'>$i</a></li>";
                                    }
                                    if($total_page > $page)
                                    {
                                            echo "<li><a href='index.php?page=".($page+1)."'>Next</a></li>";
                                    }

                                }
                         
                         ?>
                        
                           
                           
                       </ul><!--Pagination End  -->
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>

