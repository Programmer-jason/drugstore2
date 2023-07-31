<?php session_start();
include './pages/connect.php';

if (isset($_SESSION["user"])) {
  $user = $_SESSION['user'];
  $firstName = $_SESSION['firstname'];
  $lastName = $_SESSION['lastname'];
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Medicure</title>
  <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="./images/sample logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="./style/index.css">
  <link rel="stylesheet" href="./style/navbar.css" />
</head>

<body>
  <div class="container">
    <div class="clip"></div>
    <nav>
      <div class="brand">
        <img src="./images/sample logo.png" alt="no image" />
        <a href="./index.php">Medicure Drug</a>
      </div>
      <ul>
        <li><a href="./index.php">Home</a></li>
        <li><a href="./pages/medicine.php">Product</a></li>
        <li><a href="./pages/about.php">About</a></li>
        <li><a href="./pages/contact.php">Contact</a></li>
        <li> 
          <?php if(isset($_SESSION["user"])){
            switch($_SESSION["role"]){
              case "admin" :
                echo "<a href ='./pages/profile.php'>$firstName<img src='./profile/$userProfile' alt='User Profile' class='user-profile'/></a>";
                break;
              case "customer" :
                echo "<a href ='./pages/customer_pages/favorite.php'>$firstName<img src='./profile/$userProfile' alt='User Profile' class='user-profile'/></a>";
                break;
            }
          }else{
            echo "<a href ='./pages/signIn.php'>Sign In </a>";

          }
          ?>
        </li>
      </ul>
    </nav>

    <div class="intro">
      <div class="introduction">
        <h1 class="title">The drugstore you can trust.</h1>
        <h4 class="intro-paragraph">
          Your shop for all your health and personal care needs.
        </h4>
        <a href="./pages/medicine.php">See Available</a></li>
      </div>

      <div class="img-intro">
        <img src="./images/drugstore.png" alt="img">
      </div>

    </div>

  </div>
</body>

</html>