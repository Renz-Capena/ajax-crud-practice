<?php
    require "db.php";

    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];

    $edit = "UPDATE `person` SET `name`='$name',`age`='$age' WHERE id='$id'";
    
    $con->query($edit)
?>