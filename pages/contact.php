<?php session_start();
include './connect.php';

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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>contact</title>
    <link rel="shortcut icon" href="../images/sample logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/common.css" />
    <link rel="stylesheet" href="../style/contact.css" />
    <link rel="stylesheet" href="../style/navbar.css" />

</head>

<body>
    <section class="contact-main">
        <nav>
            <div class="brand">
                <img src="../images/sample logo.png" alt="no image" />
                <a href="../index.php">Medicure Drug</a>
            </div>

            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="./medicine.php">Product</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <!-- <li> 
                    <?php if (isset($_SESSION["user"])) {
                        switch ($_SESSION["role"]) {
                            case "admin":
                                echo "<a href ='./profile.php'>$firstName<img src='../profile/$userProfile' alt='User Profile' class='user-profile'/></a>";
                                break;
                            case "customer":
                                echo "<a href ='./customer_pages/favorite.php'>$firstName<img src='../profile/$userProfile' alt='User Profile' class='user-profile'/></a>";
                                break;
                        }
                    } else {
                        echo "<a href ='./signIn.php'>Sign In </a>";
                    }
                    ?>
                </li> -->
            </ul>
        </nav>

        <div class="contact-main-text">
            <h1>Our team are ready to assist you</h1>
            <p>
                Tell us what you think about our web site, our products, or anything
                else that comes to mind. We welcome all of your comments and
                suggestions.
            </p>
            <a href="#contact">Need help?</a>
        </div>
    </section>

    <section class="contact-form" id="contact">
        <h1>Contact us by filling this form</h1>
        <form action="https://formsubmit.co/drugmedicure@gmail.com" method="POST">
            <input type="text" name="fname" placeholder="First Name" required />
            <input type="text" name="lname" placeholder="Last Name" required />
            <input type="email" name="email" placeholder="Email address" required />
            <input type="text" name="phone" placeholder="Phone" required />
            <textarea name="query" id="" cols="30" rows="5" placeholder="Question or message"></textarea>

            <button type="submit">Submit</button>
        </form>
    </section>

    <script src="./js/navbar.js"></script>
</body>

</html>