<?php
    require "db.php";

    sleep(3);
    $id = $_POST['id'];

    $delete = "DELETE FROM `test` WHERE id='$id'";
    $con->query($delete);
?>