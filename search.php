<?php include 'header.php';  require_once "conn.php";
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">


                    <?php 
                            if(isset($_GET['search']))
                            {
                                $limit=5;

                                if(isset($_GET['page']))
                                {
                                    $page=mysqli_real_escape_string($conn,$_GET['page']);
                                }
                                else
                                {
                                    $page=1;
                                }

                                $offset=($page-1)*$limit;    


                                $search_term=$_GET['search'];    

                                ?>
                                     <h2 class="page-heading">Search :<?php echo $search_term; ?></h2>
                                <?php

                                $query="SELECT * FROM `post` WHERE `title` LIKE '%$search_term%' OR `author` LIKE '%$search_term%' 
                                        OR `description` LIKE '%$search_term%' ORDER BY post_id DESC LIMIT $offset,$limit";
                                $result=mysqli_query($conn,$query) or die("Query Failed.");


                                if(mysqli_num_rows($result)>0)
                                {

                                    while($data=mysqli_fetch_assoc($result))
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
                                    <h3><a href='single.php?id=<?php echo $data['post_id']; ?>'><?php echo $data['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cat=<?php echo $data['category'];?>'><?php echo $data['category'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author=<?php echo  $auth[0].$auth[1]; ?>'><?php echo $data['author'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $data['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php echo substr($data['description'],0,200)."....";?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $data['post_id']; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                                    }
                                }
                                else
                                {
                                    echo "<h1>No Records Found</h1>";
                                }
                            }

                    ?>

                    <ul class='pagination'>

                        <?php

                            $query1="SELECT * FROM `post` WHERE `title` LIKE '%$search_term%' OR `author` LIKE '%$search_term%' 
                            OR `description` LIKE '%$search_term%' ORDER BY post_id DESC";
                            $result1=mysqli_query($conn,$query1) or die("Query Failed.");

                            if(mysqli_num_rows($result1)>0)
                            {
                                
                                $total_records=mysqli_num_rows($result1);

                                $total_page=ceil($total_records/$limit);

                                if($page >1)
                                {
                                    echo "<li><a href='search.php?page=".($page-1)."&search=$search_term'>Previous</a></li>";
                                }
                                for($i=1; $i<=$total_page; $i++)
                                {
                                    if($page == $i)
                                    {
                                        $active="active";
                                    }
                                    else
                                    {
                                        $active="";
                                    }
                                    echo "<li class='$active'><a href='search.php?page=$i&search=$search_term'>$i</a></li>";
                                }
                                if($total_page>$page)
                                {
                                    echo "<li><a href='search.php?page=".($page+1)."&search=$search_term'>Next</a></li>";
                                }
                            }
                        
                        ?>
                        <!-- <li ><a href="">1</a></li>
                        
                        <li><a href="">3</a></li> -->
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
