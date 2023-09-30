<?php session_start();
include '../connect.php';

$getProductId = $_GET['cartId'];
$getProduct = "SELECT * FROM `product` WHERE productId = $getProductId";
$getProductResult = mysqli_query($conn, $getProduct);
$fetchProduct = mysqli_fetch_assoc($getProductResult);
$getproductImage = $fetchProduct['productImg'];
$getproductName = $fetchProduct['productName'];
$getproductPrice = $fetchProduct['productPrice'];
$getproductQty = $fetchProduct['productQty'];

if (mysqli_num_rows($getProductResult) > 0) {
  if (isset($_SESSION['shoppingCart'])) {
    $itemArrayId = array_column($_SESSION['shoppingCart'], 'itemId');

    if (!in_array($getProductId, $itemArrayId)) {
      $count = count($_SESSION['shoppingCart']);
      $itemArray = array(
        'itemId'  =>  "$getProductId",
        'itemImage' => "$getproductImage",
        'itemName' => " $getproductName",
        'itemPrice' => "$getproductPrice",
        'itemStock' => "$getproductQty",
        'itemQuantity' => "0",
      );

      $_SESSION['shoppingCart'][$count] = $itemArray;
      header("location: ../medicine.php");
    } else {
      echo "<script>alert('item already added')</script>";
      echo "<script>window.location = '../medicine.php'</script>";
    }
  } else {
    $itemArray = array(
      'itemId'  =>  "$getProductId",
      'itemImage' => "$getproductImage",
      'itemName' => " $getproductName",
      'itemPrice' => "$getproductPrice",
      'itemStock' => "$getproductQty",
      'itemQuantity' => "0",
    );
    $_SESSION['shoppingCart'][0] = $itemArray;
    header("location: ../medicine.php");
  }
}

?>


<!-- <a href='#' class='btn-success' onclick='getQuantity($getProductId)'>Proceed</a>
<a href='./medicine.php' class='btn-danger'>Cancel</a> -->