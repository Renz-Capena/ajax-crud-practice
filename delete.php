<?php
    require "db.php";

    $id = $_POST['id'];

    $con->query("DELETE FROM `person` WHERE id='$id'");
?>