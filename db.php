<?php
    function connect(){
        $sql = new mysqli('localhost','root','','ajax');

        return $sql;
    }

    $con = connect();

    

?>