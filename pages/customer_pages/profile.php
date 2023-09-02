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
    <link rel="stylesheet" href="../../style/profile.css" />
    <script src="../js/jsChart.js"></script>
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
        
        <a href="./favorite.php" class="box edit-profile">
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
            <div class="head-title">Profile</div>

            <ul>
                <li><a href="./profile.php"><?php echo $_SESSION['firstname']; ?><img src='../../profile/<?php echo $userProfile; ?>' alt='User Profile' class='user-profile' /> </a></li>
            </ul>
        </nav>

        <div class="user-container">
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/jsAnimation.js"></script>
    
</body>

</html>