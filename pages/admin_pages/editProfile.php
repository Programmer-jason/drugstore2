<?php include __DIR__.'\admin_header_php.php' ?>
<?php
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

<?php include __DIR__.'\admin_header_html.php'; ?>
	<div class="head-title">Edit Profile</div>
<?php include __DIR__.'\admin_header_html2.php'; ?>

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
						<input type="text" name="role" id="role" value="<?php echo $row["role"]; ?>" required disabled />

						<div>Contact</div>
						<input type="number" name="contact" id="contact" value="<?php echo '0' . $row["contact"]; ?>" required>
					</div>
				</div>

				<input type="submit" value="Update" name="submit" id="add" class="btn-success">
			</form>
		</div>
	</div>

<?php include __DIR__.'\admin_footer.php'; 
