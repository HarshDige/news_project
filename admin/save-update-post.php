<?php  require_once "conn.php";
    session_start();
    $author=$_SESSION['author'];

    if(empty($_FILES['new-image']['name']))
    {
        $newfilename=$_POST['old-image'];    
    
        // echo $newfilename;

    }
    else
    {
        echo "<pre>";
        print_r($_FILES['new-image']);

        $errors=array();

        $name=$_FILES['new-image']['name'];
        $type=$_FILES['new-image']['type'];
        $tmpname=$_FILES['new-image']['tmp_name'];
        $error=$_FILES['new-image']['error'];
        $size=($_FILES['new-image']['size'])/1024;

        echo $size;
        $nameext=explode(".",$name);
        $ext=strtolower(end($nameext));

        $extension=array("jpeg", "jpg", "png");

        if(in_array($ext,$extension) == false)
        {
            $errors[]="This Extension file not allowed,Please choose a JPG or PNG file.";
        }

        if($size > (1024*2))
        {
            $errors[] = "File Size Must be 2MB or lower.";
        }


        if(empty($errors)==true && $error==0)
        {
            $filename="./upload/".$_POST['old-image'];
            if(unlink($filename)==true)
            {

               
               $newfilename=time().$name;
               $path ="./upload/".$newfilename;
               move_uploaded_file($tmpname,$path);
            }
               
        }
        else
        {
            echo "Image Error";
        }

    
    }

  

    if(isset($_POST['submit']))
    {
        $pid=mysqli_real_escape_string($conn,$_POST['post_id']);
        
        $title=mysqli_real_escape_string($conn,$_POST['post_title']);
        $desc=mysqli_real_escape_string($conn,$_POST['postdesc']);
        $new_cat=mysqli_real_escape_string($conn,$_POST['category']);
        $old_cat=mysqli_real_escape_string($conn,$_POST['old-category']);
        $date=date("d M,Y");
     
      
        if($new_cat == $old_cat)
        {
            $query="UPDATE `post` SET `title`='$title',`description`='$desc',`category`='$new_cat',`post_date`='$date',`author`='$author',`post_img`='$newfilename' WHERE `post_id`='$pid'";
            
            $result=mysqli_query($conn,$query) or die("Query Failed");
        }   
        else
        {
            $query="UPDATE `post` SET `title`='$title',`description`='$desc',`category`='$new_cat',`post_date`='$date',`author`='$author',`post_img`='$newfilename' WHERE `post_id`='$pid';";
            $query .="UPDATE `category` SET `post`=`post`-1 WHERE `category_name`='$old_cat';";
            $query .="UPDATE `category` SET `post`=`post`+1 WHERE `category_name`='$new_cat'";

            $result=mysqli_multi_query($conn,$query) or die("Query Failed");

        } 
      
        if($result)
        {
            header("Location:$host/admin/post.php");
        }
        else
        {
            echo "Query Failed";
        }

    }

?>