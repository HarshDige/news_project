<?php require_once "conn.php";

    session_start();


    if(isset($_SESSION["username"]))
    {
        header("Location:$host/admin/post.php");
    }

    if(isset($_POST['login']))
    {
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $password=mysqli_real_escape_string($conn,md5($_POST['password']));

    

        $sql="SELECT  `first_name`,`last_name`,`user_id`,`username`,`role` FROM `user` WHERE `username`='$username' AND `password`='$password'";
        $result= mysqli_query($conn, $sql)OR die("Query failed");

        if(mysqli_num_rows($result)>0)
        {
           
            while($data =mysqli_fetch_assoc($result))
            {
                
                $_SESSION['author']=$data['first_name']." ".$data['last_name'];
                $_SESSION['username']=$data['username'];
                $_SESSION['userid']=$data['user_id'];
                $_SESSION['userrole']=$data['role'];

              
    
                header("Location:".$host."/admin/post.php");


            }
        }
        else
        {
           ?>
                <script>
                        alert("Useername And Password are not valide.");
                        window.location.href="<?php echo $host;?>/admin/index.php";
                </script>
           <?php
        }
    }

?>


<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                    <?php
                        $query="SELECT * FROM `setting`";
                        $result=mysqli_query($conn,$query);

                       $data=mysqli_fetch_assoc($result);


                        if($data['logo'] == '')
                        {
                            echo "<h1>".$data['websitename'] ."</h1>";
                        }
                        else
                        {

                            echo "<img src='images/". $data['logo']."'>";
                        }
                        ?>
                        <!-- <img class="logo" src="images/news.jpg"> -->
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php  $_SERVER['PHP_SELF'];?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
