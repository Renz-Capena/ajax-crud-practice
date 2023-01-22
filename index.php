<?php
    require "db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajax</title>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    
    <br>
    <div class="container">

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" placeholder="Name...">
            <label for="floatingInput">NAME</label>
        </div>

        <div class="form-floating">
            <input type="text" class="form-control" id="age" placeholder="Age...">
            <label>AGE</label>
        </div>
        <br>
                <!-- <input type="text" id="name" placeholder="Name...">
                <input type="text" id="age" placeholder="Age..."> -->
        <button id='addBtn' class='btn btn-success'>ADD DATA</button>
        
        <br><br>

        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>age</th>
                    <th>edit</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php
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
            </tbody>
        </table>
        <br><br>
        <div id="edit_container"></div>
    </div>

    <script>
        $(document).ready(function(){

            $("#addBtn").click(function(){

                const name = $("#name").val();
                const age = $("#age").val();

                if(name && age){
                    $.ajax({
                        method: "POST",
                        url: "insert.php",
                        data: {
                            name: name,
                            age: age
                        },
                        success:function(){
                            $("#name").val("");
                            $("#age").val("");
                            $("#tbody").load("table.php");
                        }
                    })
                }

            })

            $("#tbody").on("click","[id='deleteBtn']",function(){
                const id = $(this).val();
                if(confirm(`Are you sure to delete id number: ${id}`)){
                    $.ajax({
                        url: "delete.php",
                        method: "POST",
                        data:{
                            id : id
                        },
                        success(){
                            // alert()
                            $("#tbody").load("table.php");
                        }
                    })
                }
            })

            $("#tbody").on("click","[id='editBtn']",function(){

                const id = $(this).val();
                $("#edit_container").show();

                $.ajax({
                    url: "edit.php",
                    method: "POST",
                    data:{
                        id : id
                    },
                    success(e){
                        // alert()
                        $("#edit_container").html(e);
                    }
                })
            })

            $("#edit_container").on("click","#updateBtn",function(){

                const idEdit = $("#editId").val();
                const nameEdit = $("#editName").val();
                const ageEdit = $("#editAge").val();

                // alert(nameEdit)
                // alert(ageEdit)
                $.ajax({
                    url: "edit_data.php",
                    method: "POST",
                    data:{
                        id : idEdit,
                        name : nameEdit,
                        age : ageEdit
                    },
                    success(e){
                        // $("#edit_container").html(e);
                        $("#tbody").load("table.php");
                        $("#edit_container").hide();
                    }
                })
            })

            $("#edit_container").on('click','#closeBtn',function(){
                $("#edit_container").hide();
            })

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src='js/index.js' ></script>
</body>
</html>