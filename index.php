<?php session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Medicure</title>
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
      </ul>
    </nav>

    <div class="intro">

      <div class="introduction">
        <h1 class="title">The drugstore you can trust.</h1>
        <h4 class="intro-paragraph">
          Your shop for all your health and personal care needs.
        </h4>
        <a href="./pages/medicine.php">View Product</a>
      </div>

      <div class="img-intro">
        <img src="./images/drugstore.png" alt="img">
      </div>
    </div>

    <div class="copyright">Copyright © 2023 Medicure Drug.</div>
  </div>
</body>

</html>