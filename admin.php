
<?php
session_start();
require_once "config/db.php";

$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ? AND role = 'admin'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $admin = $stmt->fetch();

    if ($admin && $password == $admin['password']) {

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];

        header("Location: admin_dashboard.php");
        exit;

    } else {
        $message = "Invalid Admin Email or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h2>CampusConnect | SPSU</h2>
    <a href="index.php">Home</a>
</header>

<div class="auth">

    <h1>Admin Login</h1>

    <p><?php echo $message; ?></p>

    <form method="POST">

        <label>Admin Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login" class="btn">
            Login
        </button>

    </form>

</div>

</body>
</html>
