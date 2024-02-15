<?php   require_once "conn.php";

    if(isset($_GET['id']))
    {
        $id=$_GET['id'];

        $sql="SELECT `category`,`post_img` FROM `post` WHERE `post_id`='$id'";
        $res=mysqli_query($conn,$sql);


        $data=mysqli_fetch_assoc($res);
        $filename="./upload/".$data['post_img'];
        $cate=$data['category'];

        
        $query="DELETE FROM `post` WHERE `post_id`='$id';";
        $query .="UPDATE `category` SET `post`=`post`-1 WHERE `category_name`='$cate'";

        if(mysqli_multi_query($conn,$query))
        {
            unlink($filename);
            header("Location:$host/admin/post.php");
        }
        else
        {
            echo "<h4>Query Failed..</h4>";
        }
    }


?>