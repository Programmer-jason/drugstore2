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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <link rel="shortcut icon" href="../Images/sample logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="../style/signup.css">
</head>

<body>`
  <div class="container">

    <div class="right-side">
      <a href="./signin.php" class="btn-signin">SignIn</a>
      <a href="./signup.php" class="btn-signup">SignUp</a>
    </div>

    <form action="./validation/signupValidation.php" method="post">
      <h1 class="titleHead">SignUp</h1>
      
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="firstName">Firstname</label>
          <input type="text" name="firstName" id="firstName" placeholder="Firstname" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
          <label for="lastName">Lastname</label>
          <input type="text" name="lastName" id="lastName" placeholder="Lastname" class="form-control" required>
        </div>
      </div>

      <div class="form-group col-md-14">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="age">Age</label>
          <input type="number" name="age" id="age" placeholder="Age" class="form-control" min="0 " max="150">
        </div>
        <div class="form-group col-md-6">
          <label for="contact">Contact</label>
          <input type="text" name="contact" id="contact" placeholder="Contact" class="form-control" maxlength="11" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
          <label for="confirmpassword">Confirm Password</label>
          <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" class="form-control" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="address">Address</label>
          <input type="text" name="address" id="address" placeholder="address" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
          <label for="brgy">Brgy/Zone</label>
          <input type="text" name="brgy" id="brgy" placeholder="brgy" class="form-control" required>
        </div>
      </div>

      <div class="gender">
        <label for="female">Female</label>
        <input type="radio" name="gender" id="female" value="f" required>
        <label for="male">Male</label>
        <input type="radio" name="gender" id="male" value="m" required>
        <label for="others">Others</label>
        <input type="radio" name="gender" id="others" value="o" required>
      </div>

      <input type="text" name="role" value="customer" hidden>
      <input type="submit" name="submit" value="SignUp" class="submit">

      <div class="links">
        <a href="../index.php" style="margin-left: 10px;">Back to Home</a>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>