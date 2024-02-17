<?php
                        $query="SELECT * FROM `setting`";
                        $result=mysqli_query($conn,$query);

                       $data=mysqli_fetch_assoc($result);

                            
                            ?>

<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <span><?php echo $data['footerdesc']?></span>
            </div>
        </div>
    </div>
</div>

</body>
</html>
