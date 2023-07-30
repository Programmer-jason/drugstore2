<?php
    session_start() ;

    include '../connect.php';
    
    $id = $_GET["favId"];

    $sql = "DELETE FROM user_favorite WHERE product_id = $id";
    $res = mysqli_query($conn, $sql);

    if($res){
        header("location:../customer_pages/favorite.php");
    }
    mysqli_close($conn);
?>