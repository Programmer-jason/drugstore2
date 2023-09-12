<?php
session_start();
include '../connect.php';

// GET SIGNUP
$sql = "SELECT * FROM `signUp`;";
$result = mysqli_query($conn, $sql);

$userProf = $_SESSION['user']; 
$sql6 = "SELECT * FROM signup WHERE email = '$userProf'";
$result6 = mysqli_query($conn, $sql6);
$userProfile = mysqli_num_rows($result6);
$row6 = mysqli_fetch_assoc($result6);
$userId = $row6['userId'];


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

//GET PAYMENT DETAILS

$getPaymentDetails = "SELECT * FROM `paymentdetails` WHERE userId = $userId;";
$getPaymentDetailsResult = mysqli_query($conn, $getPaymentDetails);


?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>
   <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
   <link rel="stylesheet" href="../../style/navbar.css" />
   <link rel="stylesheet" href="../../style/paymentDetails.css" />
   <link rel="stylesheet" href="../../style/sidenav.css">
</head>

<body>

<div class="admin-box">
        <div class="brand">
            <img src="../../images/sample logo.png" alt="no image" />
            <a href="../../index.php">Medicure Drug</a>
        </div>

        <div class="profile-pic">
         <img src="<?php echo '../../profile/' . $row6['userProfile']; ?>" alt='<?php echo "profile"; ?>' class="user-image">
         <div>
            <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>
         </div>
      </div>

        <a href="./favorite.php" class="box favorite">
            <div><i id ='heart' class='fa-solid fa-heart fa-xl' style='color: #ffffff;' id ='heart'></i></div>
            <div>My Likes</div>
        </a>
        
        
        <a href="./paymentTransaction.php" class="box payment-transaction">
           <div><i class="fa-solid fa-money-check-dollar" style="color: #ffffff;"></i></div>
           <div>Payment Transaction</div>
         </a>
         
         <a href="./edit_profile.php" class="box edit-profile">
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
         <div class="head-title">Payment Transaction</div>

         <ul>
            <li><a href="#"><?php echo $_SESSION['firstname']; ?><img src='../../profile/<?php echo $userProfile ?>' alt='User Profile' class='user-profile' /></a></li>
        </ul>
   </nav>


   <div class="manage-account-content">
      <div class="table-container">

         <table>
            <tr>
               <th>Payment Method</th>
               <th>Name</th>
               <th>Amount</th>
               <th>Status</th>
               <th>Date Created</th>
               <!-- <th>Action</th> -->
            </tr>
            <?php if (mysqli_num_rows($getPaymentDetailsResult) > 0) : ?>
               <?php while ($rows = mysqli_fetch_assoc($getPaymentDetailsResult)) : ?>
                  <tr>
                     <td>
                        <?php echo $rows["paymentType"]?>
                     </td>

                     <td>
                        <?php echo $rows["name"]?>
                     </td>

                     <td>
                        <?php echo '₱ '.$rows["amount"].'.00'; ?>
                     </td>

                     <td>
                        <?php echo ($rows["paymentStatus"] == 'paid') ? '<div class="payment-status">'.$rows["paymentStatus"].'</div>' : '<div class="payment-status-failed">'.$rows["paymentStatus"].'</div>';?>
                     </td>

                     <td>
                        <?php echo $rows["createdAt"]; ?>
                     </td>

                     <!-- <td> -->
                        <!-- <a href="./update.php?id=<?php echo $rows['userId']; ?>" class="btn btn-primary btn-sm">Update</a> -->
                        <!-- <a href="./delete_user.php?deleteId=<?php echo $rows['userId']; ?>" class="btn btn-danger btn-sm">Delete</a> -->
                     <!-- </td> -->
                  </tr>
               <?php endwhile; ?>
            <?php endif; ?>
         </table>
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