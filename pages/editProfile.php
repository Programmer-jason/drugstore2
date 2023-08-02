<?php
session_start();
include './connect.php';

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
	$targetDir = "../profile/";

	$targetFile = $targetDir . basename($fileName);
	$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
	$typeFile = array("jpg", "png", "jpeg", "gif");

	if (!empty($fileName)) {
		if (in_array($imageFileType, $typeFile)) {
			if (file_exists($targetFile)) {
				header("location: ./editProfile.php?message=File Exist");
				exit();
			} else {
				if ($fileSize > 500000) {
					header("location: ./editProfile.php?message=File To Big");
				} else {
					if (move_uploaded_file($fileTmpname, $targetFile)) {
						header("location: ./editProfile.php?message=The file has been uploaded.");
					} else {
						header("location: ./editProfile.php?message=Error File Upload.");
					}
				}
			}
		} else {
			header("location: ./editProfile.php?message=Only jpg, jpeg, png.");
		}
	} else {
		header("location: ./editProfile.php?message=You Didnt Upload.");
	}

	$sql2 = "UPDATE `signUp`
                    SET `userProfile` = '$fileName', `firstName`='$firstName',`lastName`='$lastName', `age`='$age', `email`='$email', `password`='$password', `contact`=$contact,`gender`='$gender'
                    WHERE `userId`=$id";

	$result2 = mysqli_query($conn, $sql2);

	if ($result2) {
		header("location:./editProfile.php?message=updated successful");
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
	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
	<link rel="stylesheet" href="../style/navbar.css" />
	<link rel="stylesheet" href="../style/sidenav.css">
	<link rel="stylesheet" href="../style/editProfile.css" />
</head>

<body>

	<div class="admin-box">
		<div class="brand">
			<img src="../images/sample logo.png" alt="no image" />
			<a href="../index.php">Medicure Drug</a>
		</div>

		<div class="profile-pic">
			<img src="<?php echo '../profile/' . $row4['userProfile']; ?>" alt='<?php echo "profile"; ?>' class="user-image">
			<div>

				<?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>
			</div>
		</div>
		<a href="./profile.php" class="box dashboard">
			<div><img src="../assets/dashboard.svg" alt="dashboard" width="25px"></div>
			<div> Dashboard</div>
		</a>

		<a href="./admin_pages/inventory.php" class="box stock">
			<div><img src="../assets/inventory.svg" alt="dashboard" width="25px"></div>
			<div>Inventory</div>
		</a>

		<a href="./admin_pages/sales.php" class="box sales">
			<div><img src="../assets/sales.svg" alt="dashboard" width="25px"></div>
			<div>Sales</div>
		</a>
		<!-- 
		<a href="./admin_pages/prescription.php" class="box prescription">
            <div><img src="../assets/prescription.png" alt="dashboard" width="25px"></div>
            <div>Prescription</div>
        </a> -->

		<a href="./admin_pages/manageAccount.php" class="box manage-account">
			<div><img src="../assets/manageUsers.svg" alt="dashboard" width="25px"></div>
			<div>Users</div>
		</a>

		<!-- <a href="./admin_pages/reserved.php" class="box reserved">
      <div><img src="../../assets/.png" alt="dashboard" width="100px"></div>
      <div>Reserve</div>
    </a> -->

		<a href="./admin_pages/addMedicine.php" class="box add-medicine">
			<div style="color: red;"><img src="../assets/addProduct.svg" alt="dashboard" width="25px" style="color: red;"></div>
			<div>Add Product</div>
		</a>

		<a href="./editProfile.php" class="box edit-profile">
			<div><img src="../assets/editProfile.svg" alt="dashboard" width="25px"></div>
			<div>Edit Profile</div>
		</a>

		<a href="./logout.php" class="box logout">
			<div><img src="../assets/logout.svg" alt="dashboard" width="25px"></div>
			<div>Logout</div>
		</a>
	</div>

	<div class="content-container">
		<nav>
			<div class="head-title">Edit Profile</div>

			<ul>
				<li><a href="./profile.php"> <?php echo $_SESSION['firstname']; ?><img src='../profile/<?php echo $userProfile ?>' alt='User Profile' class='user-profile' /> </a></li>
				<li>
                    <div class="notif">
                        <img src="../assets/notif.svg" alt="home" width="20px" id="notifShow" onclick="loadDoc()">
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

		<div class="account-info">
			<form action="" enctype="multipart/form-data" method="post">
				<div class="image">
					<img src="<?php echo '../profile/' . $row6['userProfile']; ?>" alt='<?php echo "profile"; ?>'>

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
	<script>
		function loadDoc() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

				}
			};
			xhttp.open("GET", "./admin_pages/notify.php", true);
			xhttp.send();

			document.querySelector(".notifCount").style.display = "none"
		}
	</script>
</body>

</html>