<?php
    require "db.php";

    $getData = "SELECT * FROM `test`";
    $list = $con->query($getData);
    $fetch = $list->fetch_assoc();

    if($list->num_rows){
        do{
            echo"<tr>";
            echo"<td>".$fetch['id']."</td>";
            echo"<td>".$fetch['name']."</td>";
            echo"<td>".$fetch['age']."</td>";
            echo"<td><a href='edit.php?id=".$fetch['id']."'>EDIT</a></td>";
            echo"<td><button id='deleteBtn' value='".$fetch['id']."'>delete</button></td>";
            echo"</tr>";
        }while($fetch = $list->fetch_assoc());
    }
            
?>