<?php
session_start();
require_once "dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user'] = $user;
            $_SESSION['is_admin'] = $user['is_admin'];

            if (isset($_COOKIE['welcome_user']) && $_COOKIE['welcome_user'] === 'visited') {

                $_SESSION['welcome_message'] = "Welcome back, " . htmlspecialchars($user['first_name']) . "!";
            } else {
                setcookie('welcome_user', 'visited', time() + (7 * 24 * 60 * 60), "/"); // 1-week expiration
                $_SESSION['welcome_message'] = "Hi, " . htmlspecialchars($user['first_name']) . "!";
            }

            if ($user['is_admin']) {
                header('Location: admin.php');
            } else {
                header('Location: index.php');
            }
            exit();
        }
    }
    echo "Invalid email or password.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div><p>Not registered yet? <a href="customer_registration.php">Sign Up Here</a></p></div>
    </div>
</body>
</html>
