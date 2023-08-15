<?php session_start();
include '../connect.php';

//get user profile

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

$user = (isset($_SESSION["user"])) ? $_SESSION['user'] : '';
$getUser = "SELECT * FROM signUp WHERE email = '$user'";
$getUserResult = mysqli_query($conn, $getUser);
$fetchUser = mysqli_fetch_assoc($getUserResult);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="../../images/sample logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../../style/navbar.css" />
    <link rel="stylesheet" href="../../style/sidenav.css" />
    <link rel="stylesheet" href="../../style/favorite.css" />
    <script src="../js/jsChart.js"></script>
</head>

<body>

    <div class="admin-box">
        <div class="brand">
            <img src="../../images/sample logo.png" alt="no image" />
            <a href="../../index.php">Medicure Drug</a>
        </div>

        <a href="./favorite.php" class="box favorite">
            <div><i id ='heart' class='fa-solid fa-heart fa-xl' style='color: #ffffff;' id ='heart'></i></div>
            <div>My Likes</div>
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
        <div class="head-title">My Likes</div>

        <ul>
          <li><a href="#"><?php echo $_SESSION['firstname']; ?><img src='../../profile/<?php echo $userProfile; ?>' alt='User Profile' class='user-profile' /></a></li>
        </ul>
      </nav>
        
      <div class="mp-list">
        <?php
		$userIds = $fetchUser['userId'];
        
        $getFavorite = "SELECT * FROM user_favorite WHERE user_id = $userIds";
        $favoriteResult = mysqli_query($conn, $getFavorite);
    
        if (mysqli_num_rows($favoriteResult) > 0) {
          while ($fetchFavorite = mysqli_fetch_assoc($favoriteResult)) {
            $favId = $fetchFavorite['product_id'];
            // $userId2 = $fetchFavorite['user_id'];
			
            $sql = "SELECT * FROM product WHERE productId = $favId";
            $result = mysqli_query($conn, $sql);
			$rows = mysqli_fetch_assoc($result);

            // $getUser = "SELECT * FROM signup WHERE userId = $userId2";
            // $userResult = mysqli_query($conn, $getUser);
			// $fetchUser = mysqli_fetch_assoc($userResult);


            if($result){
        ?>
        <div class="mp-card" >
            <img src="<?php echo '../../uploads/' . $rows['productImg']; ?>" alt='<?php ?>' class="img-list">

            <div class="details">
              <div class="product-name">
                <?php echo $rows['productName']; ?>
              </div>

              <h2>
                <?php echo '₱'.' '.$rows['productPrice']; ?>
              </h2>

              <!-- <div>
                <?php echo $rows['productQty'] == 0 ? 'Not Available' : 'Available' ?>
              </div> -->

            </div>

            <a href="../validation/deleteFavorite.php?favId=<?php echo $rows['productId']; ?>" class='favorite-btn'><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
        </div>

        <?php }} ?>
        <?php } ?>

        <?php if (mysqli_num_rows($favoriteResult) == 0) {
        echo "<h2>No Likes To Show</h2>";
        } ?>

      </div>
    </div>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/jsAnimation.js"></script>
</body>

</html>