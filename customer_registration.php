<?php
session_start();
if (isset($_SESSION['user_id'])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN IN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class = "container">
    <?php
        if (isset($_POST["submit"])) {
           $firstName = $_POST["first_name"];
           $lastName = $_POST["last_name"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $mobile = $_POST["mobile"];
           $address = $_POST["address"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($firstName) OR empty($lastName) OR empty($email) OR empty($password) OR empty($mobile) OR empty($address)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           require_once "dbconnect.php";
           $sql = "SELECT * FROM user WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO user (first_name, last_name, email, password, mobile, address) VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"ssssss",$firstName,$lastName, $email, $passwordHash,$mobile,$address);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
        <form action="customer_registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" placeholder="First Name:" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name:" required>
            </div>
            <div class="form-group">
                <input type="emamil" class="form-control" name="email" placeholder="Email:" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="mobile" placeholder="mobile:" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Address:" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
            <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
        </div>

    </div>
    
</body>
</html>