<?php
session_start();
include '../connect.php';
if (isset($_POST['submit'])) {
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $email = htmlspecialchars($_POST["email"]);
    $age = htmlspecialchars($_POST["age"]);
    $contact = htmlspecialchars($_POST["contact"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirmpassword = htmlspecialchars($_POST["confirmpassword"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $role = htmlspecialchars($_POST["role"]);
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT firstName FROM signup WHERE firstName = '$firstName';";
    $result = mysqli_query($conn, $sql);

    if (!mysqli_num_rows($result) > 0) {
        if ($password == $confirmpassword) {
            $stmt = $conn->prepare("INSERT INTO signup (firstName, lastName, email, password, gender, age, contact, role) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssiis", $firstName, $lastName, $email, $hash, $gender, $age, $contact, $role);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        } else {
        }
    } else {
        header("location: ../signup.php?message=name exist!");
    }
    header("location: ../signIn.php?message=added successfully");
}
?>