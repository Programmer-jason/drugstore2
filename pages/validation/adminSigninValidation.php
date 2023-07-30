<?php
session_start();
include("../connect.php");

$userLogin = htmlspecialchars($_POST["userLogin"]);
$password = htmlspecialchars($_POST["password"]);

$sql = "SELECT * FROM signup WHERE email = '$userLogin'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
  if (mysqli_num_rows($result) > 0) {
    if ($userLogin == $row['email']) {
      if (!$password == $row["password"]) {
        header("location: ../adminSignin.php?message=incorrect password or username");
        exit(0);
      }
      if ($password == $row["password"] && $row['role'] == 'admin') {
        $_SESSION["user"] = filter_input(INPUT_POST, "userLogin", FILTER_SANITIZE_SPECIAL_CHARS);
        $_SESSION["password"] = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $_SESSION["firstname"] = $row["firstName"];
        $_SESSION["lastname"] = $row["lastName"];
        $_SESSION["role"] = $row["role"];
        header("location: ../profile.php?message=login successful");
        exit(0);
      } else {
        header("location: ../adminSignin.php?message=your not an admin");
        exit(0);
      }
    }
  } else {
  }
} else {
}

mysqli_close($conn);
?>