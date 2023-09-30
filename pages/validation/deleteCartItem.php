<?php session_start();
// echo json_encode($_SESSION['shoppingCart']);
$deleteItem = $_GET['deleteId'];
unset($_SESSION['shoppingCart'][$deleteItem]);
// header("location: ../medicine.php");
?>

<?php
if (isset($_SESSION['shoppingCart'])) {
    $total = 0;
    foreach ($_SESSION['shoppingCart'] as $keys => $values) {
?>
        <div class='transparent-bg'>

            <div class='name-and-image'>
                <div style='text-align: center;'><?php echo $values['itemName']; ?></div>
                <img src='../uploads/<?php echo $values['itemImage']; ?>' alt='product-image'>
            </div>

            <div class="price">₱ <?php echo $values['itemPrice']; ?></div>

            <div class="input-quanty">
                <div class="minus" onclick='minus( <?php echo $keys ?>,<?php echo $values["itemQuantity"] ?> )'>-</div>

                <div class="quantity-value<?php echo $keys ?> quantity">
                    <?php echo $values["itemQuantity"] ?>
                </div>


                <div class="add" onclick='add(<?php echo $keys ?>, <?php echo $values["itemStock"] ?>,<?php echo $values["itemQuantity"] ?>)'>+</div>
            </div>

            <div><i class="fa-solid fa-trash" style="color: #007430;" onclick="deleteItem(<?php echo $keys ?>)"></i></div>

        </div>

        <br>
    <?php $total = $total + ($values['itemPrice'] * $values['itemQuantity']);
    } ?>
<?php } else {
    echo "<div style='text-align: center;'>No item</div>";
} ?>

<hr>

<h2 class="total">total : ₱<?php echo (!empty($_SESSION['shoppingCart'])) ? $total : '0' ?></h2>