<?php session_start();
    include './connect.php';
?>

<?php include  __DIR__.'\header.php';?>

<div class="container">
    <nav>
        <div class="brand">
            <img src="../images/sample logo.png" alt="no image" />
            <a href="../index.php">Medicure Drug</a>
        </div>
    </nav>

    <section class="customer-info">
        <div class="title-head">Customer Information</div>

        <form action="../paymongoApi/createSession.php" method="post">
            <div>Name</div>
            <input type="text" name="fullname" placeholder="Fullname" required>

            <div>Email</div>
            <input type="email" name="email" placeholder="Email" required>

            <!-- <div>Contact Number</div>
            <input type="text" name="contact" maxlength="11" placeholder="Optional"> -->

            <input type="submit" value="Proceed" name="submit">
        </form>
    </section>


    <section class="footer">
        <div class="copyright">Copyright © 2023 Medicure Drug.</div>
    </section>

</div>

<?php include __DIR__.'\footer.php';?>