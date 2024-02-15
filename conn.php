<?php
        //connection 
        $hostname="localhost";
        $dbname="newssite";
        $db_uname="root";
        $db_pass="";

        $host = "http://localhost/news"; 
        $conn = mysqli_connect($hostname,$db_uname,$db_pass,$dbname);

        if($conn)
        {
            // echo "succeesfully";
        }
        else
        {
            die("Connection Failed:". mysqli_connect_error());
        }


?>