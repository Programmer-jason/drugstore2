<?php
session_start();
include '../connect.php';

$ids = $_GET['id'];

$sql3 = "SELECT * FROM `signUp`;";
$result3 = mysqli_query($conn, $sql3);
// $row = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM signUp WHERE userId ='$ids' LIMIT 1;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);



$zero = 0;

if (isset($_POST['submit'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $age = $_POST['age'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $contact = $_POST['contact'];
  $gender = $_POST['gender'];

  $sql2 = "UPDATE `signUp`
                    SET `firstName`='$firstName',`lastName`='$lastName', `age`='$age', `email`='$email', `password`='$password', `contact`=$contact,`gender`='$gender'
                    WHERE `userId`=$ids;";

  $result2 = mysqli_query($conn, $sql2);

  if ($result2) {
    header("location:../admin_pages/manageAccount.php?message=updated successful");
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

  $sql7 = "SELECT * FROM signUp WHERE email = '$user'";
  $result7 = mysqli_query($conn, $sql7);
  $row7 = mysqli_fetch_assoc($result7);

  $userProfile = $row7['userProfile'];
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
  <title>Update User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="../../style/sidenav.css" />
  <link rel="stylesheet" href="../../style/navbar.css" />
  <link rel="stylesheet" href="../../style/manageAccount.css" />
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

    <a href="../profile.php" class="box dashboard">
      <div><img src="../../assets/dashboard.svg" alt="dashboard" width="25px"></div>
      <div> Dashboard</div>
    </a>

    <a href="./inventory.php" class="box stock">
      <div><img src="../../assets/inventory.svg" alt="dashboard" width="25px"></div>
      <div>Inventory</div>
    </a>

    <a href="./sales.php" class="box sales">
      <div><img src="../../assets/sales.svg" alt="dashboard" width="25px"></div>
      <div>Sales</div>
    </a>

    <!-- <a href="./prescription.php" class="box prescription">
      <div><img src="../../assets/prescription.png" alt="dashboard" width="25px"></div>
      <div>Prescription</div>
    </a> -->

    <a href="./manageAccount.php" class="box manage-account">
      <div><img src="../../assets/manageUsers.svg" alt="dashboard" width="25px"></div>
      <div>Users</div>
    </a>

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

  <div class="content-container">
    <nav>


      <ul>
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


  <div class="manage-account-content">
    <div class="tables">
      <table>
        <tr>
          <th>Fullname</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Age</th>
          <th>Type</th>
          <th>Contact</th>
          <th colspan="2">Action</th>
        </tr>
        <?php if (mysqli_num_rows($result3) > 0) : ?>
          <?php while ($rows = mysqli_fetch_assoc($result3)) : ?>
            <tr>
              <td>
                <?php echo $rows["firstName"] . " " . $rows["lastName"]; ?>
              </td>
              <td>
                <?php echo $rows["email"]; ?>
              </td>
              <td>
                <?php echo $rows["gender"]; ?>
              </td>
              <td>
                <?php echo $rows["age"]; ?>
              </td>
              <td>
                <?php echo $rows["role"]; ?>
              </td>
              <td>
                <?php echo '0' . $rows["contact"]; ?>
              </td>
              <td>
                <a href="./update.php?id=<?php echo $rows['userId']; ?>" class="btn btn-primary btn-sm">Update</a>
                <a href="./delete_user.php?deleteId=<?php echo $rows['userId']; ?>" class="btn btn-danger btn-sm">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </table>
    </div>

    <div class="modal">
      <form action="" method="post">
        <div class="title">Update</div>
        <label for="firstName">Firstname</label>
        <input type="text" name="firstName" id="firstName" value="<?php echo $row["firstName"]; ?>" required>

        <label for="lastName">Lastname</label>
        <input type="text" name="lastName" id="lastName" value="<?php echo $row["lastName"]; ?>" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="<?php echo $row["password"]; ?>" required>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $row["email"]; ?>" required>

        <label for="gender">Gender</label>
        <input type="text" name="gender" id="gender" value="<?php echo $row["gender"]; ?>" required>

        <label for="age">Age</label>
        <input type="number" name="age" id="age" value="<?php echo $row["age"]; ?>" required>

        <label for="role">Type</label>
        <input type="text" name="role" id="role" value="<?php echo $row["role"]; ?>" required />

        <label for="contact">Contact</label>
        <input type="number" name="contact" id="contact" value="<?php echo '0' . $row["contact"]; ?>" required>

        <input type="submit" value="Update" name="submit" id="add" class="btn-success">
        <button type="button" class="btn-primary">Cancel</button>
      </form>
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