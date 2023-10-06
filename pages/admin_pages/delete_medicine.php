<?php
    session_start() ;

    include '../connect.php';
    
    $id = $_GET["deleteId"];

    $selectProduct = "SELECT * FROM product WHERE productId = '$id'";
    $productResult = mysqli_query($conn, $selectProduct);
    $productRow = mysqli_fetch_assoc($productResult);
    $img = $productRow['productImg'];
    $productName = $productRow['productName'];
    unlink('../../uploads/'.$img);
    
    $sql = "DELETE FROM product WHERE productName = '$productName'";
    $res = mysqli_query($conn, $sql);


    if($res){
        header("location:./newStock.php?e=$img");
    }
    mysqli_close($conn);
?>