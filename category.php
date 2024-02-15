<?php include 'header.php'; 
    require_once "conn.php";
          

?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->

                <div class="post-container">
                 
                    <?php
                        $limit=4;

                       
                        if(isset($_GET['cat']))
                        {
                            if(isset($_GET['page']))
                            {
                                $page=$_GET['page'];
                            }
                            else
                            {
                                $page=1;
                            }

                            $offset=($page-1)*$limit;

                            $category=$_GET['cat'];

                            echo "<h2 class='page-heading'>$category</h2>";

                            
                            $query="SELECT * FROM `post` WHERE `category`='$category' LIMIT $offset,$limit";
                            $result=mysqli_query($conn,$query);


                            if(mysqli_num_rows($result)>0)
                            {
                                
                                while ($data=mysqli_fetch_assoc($result)) 
                                {
                                    
                                    $auth=explode(' ',$data['author']);

                    ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $data['post_id']; ?>"><img src="admin/upload/<?php echo $data['post_img'];?>" alt=""/></a>
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
                                         <?php echo substr($data['description'],0,200)."....."; ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $data['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                                }
    

                            }
                        }
                    ?>
                  
                    <ul class='pagination'>
                        <?php
                                $sql="SELECT `category` FROM `post` WHERE `category`='$category'";
                                $res=mysqli_query($conn,$sql);

                                if(mysqli_num_rows($res)>0)
                                {
                                    $data=mysqli_fetch_assoc($res);
                                    $total_records=mysqli_num_rows($res);

                                    $total_page=ceil($total_records/$limit);

                                    if($page>1)
                                    {

                                        echo "<li ><a href='category.php?page=".($page-1)."&cat=".$data['category']."'>Previous</a></li>";
                                    }
                                    for($i=1;$i<= $total_page;$i++)
                                    {
                                        if($page == $i)
                                        {
                                            $active="active";  
                                        }
                                        else
                                        {
                                            $active="";
                                        }
                                            echo "<li class=".$active."><a href='category.php?page=".$i."&cat=".$data['category']."'>$i</a></li>";
                                    }
                                    if($total_page>$page)
                                    {

                                        echo "<li ><a href='category.php?page=".($page+1)."&cat=".$data['category']."'>Next</a></li>";
                                    }
                                }

                        ?>
<!-- 
                        <li class="active"><a href="">1</a></li>
                     
                        <li><a href="">3</a></li> -->
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php';?>
