<?php
    session_start() ;

    include '../connect.php';
    
    $id = $_GET["deleteId"];

    $sql = "DELETE FROM sales WHERE salesId = '$id' ";
    $res = mysqli_query($conn, $sql);

    if($res){
        header("location:./sales.php");
    }
    mysqli_close($conn);
?>