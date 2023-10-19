<?php 
    include '../connect.php';

    $quantity = $_POST['quantity'];
    $getProductId = $_GET['prodId'];

    $getProduct = "SELECT * FROM `product` WHERE productId = $getProductId";
    $getProductResult = mysqli_query($conn, $getProduct);
    $fetchProduct = mysqli_fetch_assoc($getProductResult);
    $getproductName = $fetchProduct['productName'];
    $getproductPrice = $fetchProduct['productPrice'];
    $getproductQty = $fetchProduct['productQty'];
    $minusQuantity = $getproductQty - $quantity;
    $total_amount = $getproductPrice * $quantity;
    $dateNow = date('Y-m-d');

    if(mysqli_num_rows($getProductResult) > 0){
        $updateProduct = "UPDATE product SET productQty = '$minusQuantity' WHERE productId = '$getProductId'";
        mysqli_query($conn, $updateProduct);

        $insertToPayment = "INSERT INTO `paymentdetails`(`paymentId`,`checkoutId`,`name`,`price`,`paymentStatus`,`dateRecieved`,`paymentType`,`paymentAction`) 
                            VALUES (null, '', '', $total_amount, 'paid', '$dateNow', 'overthecounter', 'recieve')";
        mysqli_query($conn, $insertToPayment);

        $insertToCheckout = "INSERT INTO `checkout_item`(`checkout_id`,`ref_id`,`item_id`,`item_name`,`item_qty`) 
                       VALUES (null, '', '$getProductId', '$getproductName', '$quantity')";
        mysqli_query($conn, $insertToCheckout);

        mysqli_close($conn);
        header('location: ../admin_pages/newStock.php');
    }
    
?>