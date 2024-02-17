<?php require_once "conn.php";

    // echo "<pre>";
    // print_r($_SERVER);
    // echo "</pre>";
 
    	// echo "<h1>".basename($_SERVER['PHP_SELF'])."</h1>";

      
    $page=basename($_SERVER['PHP_SELF']);
    
    //
    switch ($page)
     {
        case 'category.php':
            if(isset($_GET['cat']))
            {
                $cate=$_GET['cat'];
                $query="SELECT `category` FROM `post` WHERE `category`='$cate' ";
                $result=mysqli_query($conn,$query);
                $data=mysqli_fetch_assoc($result);

                $title=$data['category']." "."news";
                
            }
            else
            {
                $title="NO Category Found";
            }
            break;
        case 'single.php':
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                $query="SELECT `title` FROM `post` WHERE `post_id`=$id ";
                $result=mysqli_query($conn,$query);
                $data=mysqli_fetch_assoc($result);

                $title=$data['title'];
            }
            else
            {
                $title="NO Post Found";
            }
            
            break;
        case 'search.php':
            if(isset($_GET['search']))
            {
               
                $title=$_GET['search'];
            }
            else
            {
                $title="NO Seacrch";
            }
            
            break;
        case 'author.php':
            if(isset($_GET['author']))
            {
                $sql='SELECT `first_name`,`last_name` FROM `user`';
                $res=mysqli_query($conn,$sql);

                if($res)
                {
                    while($data1=mysqli_fetch_assoc($res))
                    {
                        $a1=$data1['first_name'].$data1['last_name'];
                        if($a1 == $_GET['author'])
                        {
                            $author=$data1['first_name']." ".$data1['last_name'];
                        }
                    }
                }

                $title="News By ".$author;
            }
            else
            {
                $title="NO Post Found";
            }
            
            break;
        
        default:
            $title="News-site";
            
            break;
    }
    
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
            <?php
                        $query="SELECT * FROM `setting`";
                        $result=mysqli_query($conn,$query);

                       $data=mysqli_fetch_assoc($result);


                if($data['logo'] == '')
                {
                    echo "<a href='post.php'>".$data['websitename'] ."</a>";
                }
                else
                {

                    echo "<a href='index.php' id='logo'><img src='admin/images/". $data['logo']."'></a>";
                }
                ?>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
     <div ><!--class="container" -->
        <div class="row">
             <div><!-- class="col-md-12" -->
                <ul class='menu'>
                <li><a class="nav-link" href='index.php' onclick="act()" class="check" id="home">Home</a></li>

    
                    <?php require_once "conn.php";

                        if(isset($_GET['cat']))
                        {
                            $cate=$_GET['cat'];
                        }
                        else
                        {
                            $cate="";
                        }

                      
                        $query="SELECT `category_name` FROM `category` WHERE `post`>0";
                        $result=mysqli_query($conn,$query) or die("Query Failed:category");

                        if(mysqli_num_rows($result)>0)
                        {
                           
                            while($data=mysqli_fetch_assoc($result))
                            {
                                if($cate==trim($data['category_name']))
                                {
                                    $active="active";
                                }
                                else
                                {
                                    $active="";
                                }
                                ?>
                                    <li><a class='<?php echo $active;?>' href='category.php?cat=<?php echo $data['category_name']; ?>'><?php echo $data['category_name']; ?></a></li>";
                                <?php
                            }

                            
                        }

                    ?>
                   
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- /Menu Bar -->
