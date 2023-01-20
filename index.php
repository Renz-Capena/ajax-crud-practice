<?php
    require "db.php";

    $command = "SELECT * FROM `test`";
    $list = $con->query($command);
    $num = $list->num_rows;


    // $result = $con->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'ajax'");

    // echo "<table>";
    // echo "<tr><th>Table Name</th></tr>";
    // while($row = mysqli_fetch_array($result)) {
    //     echo "<tr><td>" . $row["table_name"] . "</td></tr>";
    // }
    // echo "</table>";



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <input type="text" id='input1'>
        <br><br>
        <input type="text" id='input2'>
        <br><br>
        <button id='btn'>ADD</button>
    </div>
    <p id='numberRows'></p>

    <br><br>
    <img src="https://media.tenor.com/UnFx-k_lSckAAAAM/amalie-steiness.gif" id="loading" style='display:none;width:30px'>
   

    <br><br><br>

    <script> 
        $(document).ready(function(){
            $("#btn").click(function(){
                const a = $("#input1").val();
                const b = $("#input2").val();

                $.ajax({
                    method: "POST",
                    url: "insert.php",
                    data: {
                        value1 : a,
                        value2 : b
                    },
                    beforeSend:function(){
                        $("#loading").show();
                    },
                    success:function(data){

                        $("#input1").val("");
                        $("#input2").val("");

                        $("#loading").hide();

                        $("#numberRows").html(data);

                        $("#tbody").load("table.php")
                    }
                })

            })
            // $("#ela").on("click", ".myButton21", function () {

            // $('[id="deleteBtn"]').click(function(){

            //     //FIXING THE VALUE TO DELETE
            //     const value = $(this).val();
            //     alert(value);
            //     //

            //     $.ajax({
            //         method: "POST",
            //         url: "delete.php",
            //         data: {
            //             id:value
            //         },
            //         success:function(data){

            //             $("#tbody").load("table.php")
            //         }
            //     })
            // })

            $("#tbody").on("click", "[id='deleteBtn']", function () {
                //FIXING THE VALUE TO DELETE
                const value = $(this).val();

                if(confirm(`Delete the number ${value}?`)){
                    $.ajax({
                        method: "POST",
                        url: "delete.php",
                        data: {
                            id:value
                        },
                        beforeSend:function(){
                        $("#loading").show();

                        },
                        success:function(data){
                            $("#loading").hide();
            
                            $("#tbody").load("table.php")
                        }
                    })
                };
            })
        })
        
    </script>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>age</th>
                <th>action</th>
            </tr>
        </thead>
        <!-- <button value='".$fetch['id']."'>delete</button> -->
        <tbody id="tbody">
            <?php 

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
        </tbody>
    </table>

    <!-- <script> 
        $(document).ready(function(){
            $("#btn").click(function(){
                const a = $("#input1").val();
                const b = $("#input2").val();

                $.ajax({
                    method: "POST",
                    url: "insert.php",
                    data: {
                        value1 : a,
                        value2 : b
                    },
                    beforeSend:function(){
                        $("#loading").show();
                        $("#output").hide();
                    },
                    success:function(data){

                        $("#input1").val("");
                        $("#input2").val("");

                        $("#loading").hide();
                        $("#output").html(data);
                        $("#output").show();

                        $("#tbody").load("table.php")
                    }
                })

            })

            $('[id="deleteBtn"]').click(function(){

                //FIXING THE VALUE TO DELETE
                const value = $(this).val();
                alert(value);
                //

                $.ajax({
                    method: "POST",
                    url: "delete.php",
                    data: {
                        id:value
                    },
                    success:function(data){

                        $("#tbody").load("table.php")
                    }
                })
            })
        })
    </script> -->
</body>
</html>