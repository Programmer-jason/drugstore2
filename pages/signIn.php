<?php 
  if(isset($_GET['message'])){
    $getMessage = $_GET['message'];
    echo "<script>alert('$getMessage')</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign In</title>
  <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <link rel="shortcut icon" href="../Images/sample logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="../style/signin.css">
</head>

<body>
  <div class="container"  onclick="createInvoice()">
    <div class="head-links">
      <a href="./signin.php" class="btn-signin">Sign in</a>
      <a href="./signup.php" class="btn-signup">Sign up</a>
    </div>

    <form action="./validation/signinValidation.php" method="post">
      <h1 class="titleHead">Sign in</h1>

      <div class="form-group">
        <label for="userLogin">Email</label>
        <input type="text" id="userLogin" name="userLogin" placeholder="Email" class="form-control" required />
      </div>

      <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" id="pass" name="password" placeholder="password" class="form-control" required />
      </div>

      <input type="submit" name="submit" value="Login" class="submit">

      <div class="links">
        <a href="../index.php">Back to Home</a>
        <a href="../index.php">Forgot Password</a>
        <a href="./adminSignin.php">Your Admin? Login here!</a>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>


</html>