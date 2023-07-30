<?php
    session_start() ;

    include '../connect.php';
    
    $id = $_GET["deleteId"];

    $sql = "DELETE FROM signup WHERE userId = '$id' ";
    $res = mysqli_query($conn, $sql);

    if($res){
        header("location:./manageAccount.php");
    }
    mysqli_close($conn);
?>
