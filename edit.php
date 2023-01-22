<?php
    require "db.php";

    $id = $_POST['id'];

    // $get_info = "SELECT * FROM `person` WHERE id='$id'";
    $list = $con->query("SELECT * FROM `person` WHERE id='$id'");

    $fetch_edit = $list->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="css/index.css"> -->
</head>
<body>
    <div>
        <div class='closeBtn_wrapper'>
            <button class='btn btn-danger' id="closeBtn">CLOSE</button>
        </div>
        <br>
        <input type="hidden" id='editId' value='<?php echo $fetch_edit['id'] ?>'>
        <input type="text" id='editName' value='<?php echo $fetch_edit['name'] ?>'>
        <input type="text" id='editAge' value='<?php echo $fetch_edit['age'] ?>'>
        <br><br>
        <button class='btn btn-success' id="updateBtn">UPDATE</button>
    </div>
</body>
</html>