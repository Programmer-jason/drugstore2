<?php session_start();
include '../connect.php';

$userProf = $_SESSION['user'];

$sql6 = "SELECT * FROM signup WHERE email = '$userProf'";
$result6 = mysqli_query($conn, $sql6);
$userProfile = mysqli_num_rows($result6);
$row6 = mysqli_fetch_assoc($result6);

if (isset($_SESSION["user"])) {
  $user = $_SESSION['user'];

  $sql = "SELECT * FROM signUp WHERE email = '$user'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $userProfile = $row['userProfile'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="../../style/navbar.css" />
  <link rel="stylesheet" href="../../style/sidenav.css" />
  <link rel="stylesheet" href="../../style/reserved.css" />
</head>

<body>
  <div class="admin-box">
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
      <div><img src="../../assets/inventory.png" alt="dashboard" width="25px"></div>
      <div>Inventory</div>
    </a>

    <a href="./sales.php" class="box sales">
      <div><img src="../../assets/sales.svg" alt="dashboard" width="25px"></div>
      <div>Sales</div>
    </a>

    <!-- <a href="./prescription.php" class="box prescription">
      <div><img src="../../assets/prescription.png" alt="dashboard" width="25px"></div>
      <div>Prescription</div>
    </a>

    <a href="./manageAccount.php" class="box manage-account">
      <div><img src="../../assets/manageUsers.svg" alt="dashboard" width="25px"></div>
      <div>Users</div>
    </a> -->

    <!-- <a href="./reserved.php" class="box reserved">
      <div><img src="../../assets/.png" alt="dashboard" width="100px"></div>
      <div>Reserve</div>
    </a> -->

    <a href="./addMedicine.php" class="box add-medicine">
      <div><img src="../../assets/addProduct.png" alt="dashboard" width="25px"></div>
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
      <div class="brand">
        <img src="../../images/sample logo.png" alt="no image" />
        <a href="../../index.php">Medicure Drug</a>
      </div>

      <ul>
        <li><a href="../../index.php">Home</a></li>
        <li><a href="../profile.php"><?php echo $_SESSION['firstname']; ?><img src='../../profile/<?php echo $userProfile ?>' alt='User Profile' class='user-profile' /></a></li>
      </ul>
    </nav>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../js/jsAnimation"></script>
</body>

</html>