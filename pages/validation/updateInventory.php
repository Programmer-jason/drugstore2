<?php session_start();
include '../connect.php';

$updateId = $_GET["updateId"];

$sql = "SELECT * FROM product WHERE productId = $updateId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql2 = "SELECT * FROM product";
$result2 = mysqli_query($conn, $sql2);

if (isset($_POST['submit'])) {
   $productName = $_POST['productName'];
   $expiredDate = $_POST['expiredDate'];
   $stock = $_POST['stock'];
   $productPrice = $_POST['productPrice'];

   $sqlUpdate = "UPDATE `product` SET `productName`='$productName',`productExpired`='$expiredDate',`productQty`='$stock',`productPrice`='$productPrice' WHERE `productId` = '$updateId'";

   $updateSql = mysqli_query($conn, $sqlUpdate);

   if ($updateSql) {
      header("location:../admin_pages/inventory.php?message=updated successful");
   } else {
      echo mysqli_error($conn);
   }
   mysqli_close($conn);
} else {
   echo mysqli_error($conn);
}

$userProf = $_SESSION['user'];

$sql6 = "SELECT * FROM signup WHERE email = '$userProf'";
$result6 = mysqli_query($conn, $sql6);
$userProfile = mysqli_num_rows($result6);
$row6 = mysqli_fetch_assoc($result6);

if (isset($_SESSION["user"])) {
   $user = $_SESSION['user'];

   $sql4 = "SELECT * FROM signUp WHERE email = '$user'";
   $result4 = mysqli_query($conn, $sql4);
   $row4 = mysqli_fetch_assoc($result4);

   $userProfile = $row4['userProfile'];
}
//NOTIFICATION

$sqlNotifys = "SELECT * FROM product WHERE notificationType = 'nr'";
$resultNotifys = mysqli_query($conn, $sqlNotifys);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inventory</title>
   <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@500&display=swap" rel="stylesheet">
   <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <link rel="stylesheet" href="../../style/navbar.css" />
   <link rel="stylesheet" href="../../style/sidenav.css" />
   <link rel="stylesheet" href="../../style/inventory.css" />

</head>
<body>

   <div class="admin-box">
      <div class="brand">
         <img src="../../images/sample logo.png" alt="no image" />
         <a href="#">Medicure Drug</a>
      </div>

      <div class="profile-pic">
         <img src="<?php echo '../../profile/' . $row6['userProfile']; ?>" alt='<?php echo "profile"; ?>' class="user-image">
         <div>
            <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>
         </div>
      </div>


      <a href="../profile.php" class="box dashboard">
         <div><img src="../../assets/dashboard.svg" alt="dashboard" width="25px"></div>
         <div> Dashboard</div>
      </a>

      <a href="../admin_pages/inventory.php" class="box stock">
         <div><img src="../../assets/inventory.svg" alt="dashboard" width="25px"></div>
         <div>Inventory</div>
      </a>

    <?php if($row6['role'] == 'admin') {?>
         <a href="../admin_pages/sales.php" class="box sales">
            <div><img src="../../assets/sales.svg" alt="dashboard" width="25px"></div>
            <div>Sales</div>
         </a>

         <!-- <a href="../admin_pages/prescription.php" class="box prescription">
            <div><img src="../../assets/prescription.png" alt="dashboard" width="25px"></div>
            <div>Prescription</div>
         </a> -->


         <a href="../admin_pages/manageAccount.php" class="box manage-account">
            <div><img src="../../assets/manageUsers.svg" alt="dashboard" width="25px"></div>
            <div>Users</div>
         </a>
      <?php } ?>

      <a href="./paymentDetails.php" class="box reserved">
         <div><i class="fa-solid fa-money-check-dollar" style="color: #ffffff;"></i></div>
         <div>Payment</div>
      </a>
      
      <a href="../admin_pages/addMedicine.php" class="box add-medicine">
         <div><img src="../../assets/addProduct.svg" alt="dashboard" width="25px"></div>
         <div>Add Product</div>
      </a>

      <a href="../editProfile.php" class="box edit-profile">
         <div><img src="../../assets/editProfile.svg" alt="dashboard" width="25px"></div>
         <div>Edit Profile</div>
      </a>

      <a href="../logout.php" class="box logout">
         <div><img src="../../assets/logout.svg" alt="dashboard" width="25px"></div>
         <div>Logout</div>
      </a>


   </div>

   <div class="content-container">
      <nav>
         <div class="head-title">Edit Stock</div>

         <ul>
            <i class="fa fa-times" aria-hidden="true"></i>
            <li><a href="../profile.php"><?php echo $_SESSION['firstname']; ?><img src='../../profile/<?php echo $userProfile ?>' alt='User Profile' class='user-profile' /></a></li>
            <li>
                    <div class="notif">
                        <img src="../../assets/notif.svg" alt="home" width="20px" id="notifShow" onclick="loadDoc()">
                        <?php echo (mysqli_num_rows($resultNotifys) > 0) ? '<div class="notifCount">' . mysqli_num_rows($resultNotifys) . '</div>' : ''; ?>

                        <div class="notifContent">
                            <div class="notifTittle">Notification</div>

                            <?php
                            $sql8 = "SELECT * FROM product WHERE notificationType = 'nr' ORDER BY productId DESC";
                            $result8 = mysqli_query($conn, $sql8);
                            while ($rw = mysqli_fetch_assoc($result8)) { ?>
                                <?php echo ($rw['notificationType'] == "nr") ? "<div class='notif-inbox-nr'>" : "<div class='notif-inbox'>"; ?>

                                <div class="notif-message">The Item <?php echo $rw['productName']; ?> is Expired</div>
                                <div class="notif-message"><?php echo date('s') . ' ' . 'seconds ago' ?></div>
                        </div>
                    <?php } ?>

                    </div>
    </div>
    </li>
   </ul>
   </nav>


   <div class="inventory-content">

      <div class="modal">
         <form action="" method="post">
            <div>Product Name</div>
            <input type="text" name="productName" id="productName" value="<?php echo $row["productName"]; ?>" required>

            <div>Expired Date</div>
            <input type="date" name="expiredDate" id="expiredDate" value="<?php echo $row["productExpired"]; ?>" required>

            <div>Stock</div>
            <input type="number" name="stock" id="stock" value="<?php echo $row["productQty"]; ?>" required>

            <div>Price</div>
            <input type="number" name="productPrice" id="productPrice" value="<?php echo $row["productPrice"]; ?>" required><br />

            <input type="submit" value="Update" name="submit" id="add" class="btn-success">
         </form>
      </div>
   </div>
   </div>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="../../js/jsAnimation.js"></script>
   <script>
      function loadDoc() {
         var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

            }
         };
         xhttp.open("GET", "./notify.php", true);
         xhttp.send();

         document.querySelector(".notifCount").style.display = "none"
      }
   </script>
</body>

</html>