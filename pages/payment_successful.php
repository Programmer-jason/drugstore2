
<?php include  __DIR__.'\header.php';?>
<?php 

    if(!isset($_SESSION['reference_id'])){
        header("location: ./medicine.php");
    }
?>

    <div class="container">
        
        <nav>
            <div class="brand">
                <img src="../images/sample logo.png" alt="no image" />
                <a href="../index.php">Medicure Drug</a>
            </div>
        </nav>

        <section class="<?php echo ($_SESSION['payment_status'] == 'paid') ? 'payment-success' : 'payment-failed'?>">
            <?php echo ($_SESSION['payment_status'] == 'paid') ? '
                <div class="payment-successful">Payment Successful</div>' : '<div class="payment-fail">Payment Failed</div>'
            ?>
            <span>TRANSACTION NUMBER</span>
            <span class="reference"><?php echo $_SESSION['reference_id']; ?></span>
            <br>
            <div>NAME</div>
            <span class="name"><?php echo $_SESSION['customer_name']; ?></span>
            <br>
            <div>Amount</div>
            <span class="name"><?php echo $_SESSION['totalAmount']; ?></span>
            <br>
            <div>Payment Method</div>
            <span class="name"><?php echo $_SESSION['payment_method']; ?></span>
            <br>
            <a href="./view_item.php?refId=<?php echo $_SESSION['reference_id']; ?>">View Product</a>
            <a href="./session_destroy.php">Go Back</a>
        </section>

    </div>

<?php include __DIR__.'\footer.php';?>

