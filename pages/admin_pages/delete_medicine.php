<?php
    session_start() ;

    include '../connect.php';
    
    $id = $_GET["deleteId"];

    $sql = "DELETE FROM product WHERE productId = '$id' ";
    $res = mysqli_query($conn, $sql);

    if($res){
        header("location:./inventory.php");
    }
    mysqli_close($conn);
?>