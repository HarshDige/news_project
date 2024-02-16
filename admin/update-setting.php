<?php   require_once "conn.php";

  

    if(isset($_POST['savesetting']))
    {
      

        if(empty($_FILES['new-image']['name']))
        {
            $newfilename=$_POST['old-image'];
        }
        else
        {
            echo "<pre>";
            print_r($_FILES['new-image']);
            echo "</pre>";
    
            $errors = array();
    
            $name=$_FILES['new-image']['name'];
            $type=$_FILES['new-image']['type'];
            $tmpname=$_FILES['new-image']['tmp_name'];
            $error=$_FILES['new-image']['error'];
            $size=($_FILES['new-image']['size'])/1024;
        
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
                $filename="./images/".$_POST['old-image'];
                if(unlink($filename)==true)
                {
    
                   
                   $newfilename=time().$name;
                   $path ="./images/".$newfilename;
                   move_uploaded_file($tmpname,$path);
                }
                   
            }
            else
            {
                echo "Image Error";
            }
    
        
        
        }

        $sitename=mysqli_real_escape_string($conn,$_POST['website_name']);
        $footer=mysqli_real_escape_string($conn,$_POST['footer']);

        // echo $sitename."<br>";
        // echo $footer."<br>";
        // echo $newfilename;
    
        $query="UPDATE `setting` SET `websitename`='$sitename',`logo`='$newfilename',`footerdesc`='$footer'";
        $result=mysqli_query($conn,$query) or die("Query Failed Setting..");

        if($result)
        {
            header("Location:$host/admin/setting.php");
        }
        else
        {
            echo "Query Failed Setting";
        }
    }

?>