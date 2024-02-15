<?php  require_once "conn.php";

    session_start();

    if(isset($_POST['submit']))
    {
        $title = mysqli_real_escape_string($conn,$_POST['post_title']);    
        $description = mysqli_real_escape_string($conn,$_POST['postdesc']);    
        $cat = mysqli_real_escape_string($conn,$_POST['category']);    
        $date= date("d M,Y");
        $author = $_SESSION['author']; 


        

       if(isset($_FILES['photo']))
       {
            echo "<pre>";
            print_r($_FILES);

            $errors = array();

            $name = $_FILES['photo']['name'];
            $fileerror = $_FILES['photo']['error'];
            $size = ($_FILES['photo']['size']) / 1024;
            $tmpname = $_FILES['photo']['tmp_name'];
            $type = $_FILES['photo']['type'];

            $filext = explode(".", $name);
            $ext = strtolower(end($filext));
            $extension = array("jpeg", "jpg", "png");

            if (in_array($ext, $extension) == false) {
                $errors[] = "This Extension file not allowed,Please choose a JPG or PNG file.";
            }
            

            if ($size > (1024*2)) {
                $errors[] = "File Size Must be 2MB or lower.";
            }

            if(empty($errors)==true  && $fileerror == 0)
            {
                $filename = time().$name;
                $path ="./upload/".$filename;
                move_uploaded_file($tmpname,$path);

                $query="INSERT INTO `post`(`title`,`description`,`category`,`post_date`,`author`,`post_img`) 
                        VALUES('$title','$description','$cat','$date','$author','$filename');";
                $query .="UPDATE `category` SET `post`=`post`+1 WHERE `category_name`='$cat'";

                $result=mysqli_multi_query($conn,$query);    
                if($result)
                {
                    
                    header("Location:".$host."/admin/post.php");
                }
                else
                {
                    echo "<h3>Query Failed.</h3>";
                }


            }
            else
            {
                ?>
                        <script>
                                alert("Image Extension Must Be JPG Or Png And File size must be 2mb or less!");
                                window.location.href="add-post.php";                
                         </script>   


                <?php
            }          
         
       }
    }
?>