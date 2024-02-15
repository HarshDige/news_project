<?php
     require_once "conn.php";

     if(isset($_GET['did']))
     {
        $id=$_GET['did'];
        
        $query="DELETE FROM `category` WHERE `category_id`='$id'";
        $result=mysqli_query($conn,$query) OR die("Query Failed.");

        if($result)
        {
            
            header("Location:".$host."/admin/category.php");
        }
        else
        {
            echo "Error";
        }

     }

?>