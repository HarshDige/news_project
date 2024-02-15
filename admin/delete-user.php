<?php    
            require_once "conn.php";

            if(isset($_GET['id']))
            {
            $id = $_GET['id'];

            // echo $id;

            $query = "DELETE FROM `user` WHERE `user_id` = '$id'";
            $result = mysqli_query($conn,$query);


            if($result)
            {
                header("Location:$host/admin/users.php");
            }
            else
            {
                echo "Error"; 
            }


            }


        
     
?>

