<?php session_start();
include '../connect.php'; //CONNECT TO DATABASE

//ERROR MESSEGE
if(isset($_GET['message'])){
    $getMessage = $_GET['message'];
    echo "<script>alert('$getMessage')</script>";
}

//GET ALL FROM CUSTOMER
$sql = "SELECT * FROM `signUp` WHERE `role` = 'customer';";
$result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);

//SELECT ALL FROM SIGNUP
$sql2 = "SELECT * FROM `signUp`;";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);

// SELECT USER
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

$head_title = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Medicure Drug</title>
   <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="shortcut icon" href="../../images/sample logo.png" type="image/x-icon" />
   <link rel="stylesheet" href="../../style/navbar.css" />
   <link rel="stylesheet" href="../../style/sidenav.css">
   <!-- MANAGE ACCOUNT CSS -->
    <link rel="stylesheet" href="../../style/manageAccount.css" /> 
   <!-- ADD SALES CSS -->
   <link rel="stylesheet" href="../../style/sales.css" />
   <link rel="stylesheet" href="../../style/add_sales.css" />

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

         <a href="./inventory.php" class="box stock">
            <div><img src="../../assets/inventory.svg" alt="dashboard" width="25px"></div>
            <div>Inventory</div>
         </a>

         <?php if($row6['role'] == 'admin') {?>
            <a href="../admin_pages/sales.php" class="box sales">
               <div><img src="../../assets/sales.svg" alt="dashboard" width="25px"></div>
               <div>Sales</div>
            </a>

            <a href="../admin_pages/manageAccount.php" class="box manage-account">
               <div><img src="../../assets/manageUsers.svg" alt="dashboard" width="25px"></div>
               <div>Users</div>
            </a>
         <?php } ?>

         <a href="./paymentDetails.php" class="box reserved">
            <div><i class="fa-solid fa-money-check-dollar" style="color: #ffffff;"></i></div>
            <div>Payment</div>
         </a>
         
         <a href="./addMedicine.php" class="box add-medicine">
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

   <section class='content-container'>
      <!-- NAVBAR -->
      <nav>


