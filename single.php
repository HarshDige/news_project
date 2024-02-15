<?php include 'header.php'; 
    require_once "conn.php";

    if(isset($_GET['id']))
    {
        $pid=$_GET['id'];
        	
       
        $query="SELECT * FROM `post` WHERE `post_id`=$pid";
        $result=mysqli_query($conn,$query);
        
        if(mysqli_num_rows($result)>0)
        {
                $data=mysqli_fetch_assoc($result);
                $auth=explode(' ',$data['author']);
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $data['title']; ?></h3>
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
                            <img class="single-feature-image" src="admin/upload/<?php echo $data['post_img']; ?>" alt=""/>
                            <p class="description">
                                     <?php echo $data['description']; ?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php';
        }

    }

?>


