<?php
    require "db.php";

    $show = "SELECT * FROM `person`";
    $list_show = $con->query($show);
    $fetch = $list_show->fetch_assoc();

    do{
        echo"<tr>";
        echo"<td>".$fetch['id']."</td>";
        echo"<td>".$fetch['name']."</td>";
        echo"<td>".$fetch['age']."</td>";
        echo"<td><button id='editBtn' class='btn btn-primary' value='".$fetch['id']."'>EDIT</button></td>";
        echo"<td><button id='deleteBtn' class='btn btn-danger' value='".$fetch['id']."'>delete</button></td>";
        echo"</tr>";
    }while($fetch = $list_show->fetch_assoc());
?>