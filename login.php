
<?php
session_start();
require_once "config/db.php";

$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        header("Location: index.php");
        exit;

    } else {
        $message = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h2>CampusConnect | SPSU</h2>
    <nav>
        <a href="index.php">Home</a>
        <a href="register.php">Sign Up</a>
    </nav>
</header>

<div class="auth">

    <h1>Student Login</h1>

    <p><?php echo $message; ?></p>

    <form method="POST">

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login" class="btn">
            Login
        </button>

    </form>

    <p>New Student?
        <a href="register.php">Sign Up</a>
    </p>

</div>

</body>
</html>
