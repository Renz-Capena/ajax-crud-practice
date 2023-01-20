<?php
    require "db.php";

    sleep(3);

    // echo $_POST['value1'], $_POST['value2'];

    if(isset($_POST['value1'])){
        $name = $_POST['value1'];
        $age = $_POST['value2'];

        $insert = "INSERT INTO `test`(`name`, `age`) VALUES ('$name','$age')";

        $con->query($insert);
    }

    $number = "SELECT * FROM `test`";
    $q = $con->query($number);

    echo $q->num_rows;


?>