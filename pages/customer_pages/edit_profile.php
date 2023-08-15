<?php
session_start();
include '../connect.php';

$myAccount = $_SESSION['user'];


$sql = "SELECT * FROM `signUp` WHERE email = '$myAccount';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row['userId'];

if (isset($_POST['submit'])) {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$age = $_POST['age'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$contact = $_POST['contact'];
	$gender = $_POST['gender'];

	$fileName = $_FILES["upload"]["name"];
	$fileTmpname = $_FILES["upload"]["tmp_name"];
	$fileSize = $_FILES["upload"]["size"];
	$fileType = $_FILES["upload"]["type"];
	$targetDir = "../../profile/";

	$targetFile = $targetDir . basename($fileName);
	$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
	$typeFile = array("jpg", "png", "jpeg", "gif");

	if (!empty($fileName)) {
		if (in_array($imageFileType, $typeFile)) {
				if ($fileSize > 500000) {
					header("location: ./edit_profile.php?message=File To Big");
				} else {
					if (move_uploaded_file($fileTmpname, $targetFile)) {
						header("location: ./edit_profile.php?message=The file has been uploaded.");
					} else {
						header("location: ./edit_profile.php?message=Error File Upload.");
					}
				}
		} else {
			header("location: ./edit_profile.php?message=Only jpg, jpeg, png.");
		}
	} else {
		header("location: ./edit_profile.php?message=You Didnt Upload.");
	}

	$sql2 = "UPDATE `signUp`
                    SET `userProfile` = '$fileName', `firstName`='$firstName',`lastName`='$lastName', `age`='$age', `email`='$email', `password`='$password', `contact`=$contact,`gender`='$gender'
                    WHERE `userId`=$id";

	$result2 = mysqli_query($conn, $sql2);

	if ($result2) {
		header("location:./edit_profile.php?message=updated successful");
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="shortcut icon" href="../../images/sample logo.png" type="image/x-icon" />
	<link rel="stylesheet" href="../../style/navbar.css" />
	<link rel="stylesheet" href="../../style/sidenav.css">
	<link rel="stylesheet" href="../../style/editProfile.css" />
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
			<div class="head-title">Edit Profile</div>

			<ul>
				<li><a href="#"> <?php echo $_SESSION['firstname']; ?><img src='../../profile/<?php echo $userProfile ?>' alt='User Profile' class='user-profile' /></a></li>
	        </ul>
	</nav>

	<div class="manage-account-content">

		<div class="account-info">
			<form action="" enctype="multipart/form-data" method="post">
				<div class="image">
					<img src="<?php echo '../../profile/' . $row6['userProfile']; ?>" alt='<?php echo "profile"; ?>'>

					<input type="file" name="upload" id="profile" class="upload-file">
					<div class="name">
						<?php echo $row['firstName'] . ' ' . $row['lastName'] ?>
					</div>
				</div>

				<div class="right">
					<div class="one">
						<div>Firstname</div>
						<input type="text" name="firstName" id="firstName" value="<?php echo $row["firstName"]; ?>" required>

						<div>Lastname</div>
						<input type="text" name="lastName" id="lastName" value="<?php echo $row["lastName"]; ?>" required>

						<div>Password</div>
						<input type="password" name="password" id="password" value="<?php echo $row["password"]; ?>" required>

						<div>Email</div>
						<input type="text" name="email" id="email" value="<?php echo $row["email"]; ?>" required>
					</div>

					<div class="two">
						<div>Gender</div>
						<input type="text" name="gender" id="gender" value="<?php echo $row["gender"]; ?>" required>

						<div>Age</div>
						<input type="number" name="age" id="age" value="<?php echo $row["age"]; ?>" required>

						<div>Type</div>
						<input type="text" name="role" id="role" value="<?php echo $row["role"]; ?>" required />

						<div>Contact</div>
						<input type="number" name="contact" id="contact" value="<?php echo '0' . $row["contact"]; ?>" required>
					</div>
				</div>

				<input type="submit" value="Update" name="submit" id="add" class="btn-success">
			</form>
		</div>

	</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="../js/jsAnimation.js"></script>
	
</body>

</html>