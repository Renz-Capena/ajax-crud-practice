<?php
    require "db.php";

    $name = $_POST['name'];
    $age = $_POST['age'];

    $sql = "INSERT INTO `person`(`name`, `age`) VALUES ('$name','$age')";
    $con->query($sql);
?>