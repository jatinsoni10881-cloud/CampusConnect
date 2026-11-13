
<?php
require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $roll_no = trim($_POST["roll_no"]);
    $password = $_POST["password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email.";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO users
                    (name, email, roll_no, password)
                    VALUES (?, ?, ?, ?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $name,
                $email,
                $roll_no,
                $hashedPassword
            ]);

            $message = "Registration successful! You can now login.";

        } catch (PDOException $e) {
            $message = "Email already registered or database error.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Sign Up | CampusConnect</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h2>CampusConnect | SPSU</h2>
    <nav>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
    </nav>
</header>

<main class="auth">
    <h1>Student Sign Up</h1>

    <?php if ($message != ""): ?>
        <p class="notice">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <label>Full Name</label>
        <input type="text" name="name" required>

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Roll Number</label>
        <input type="text" name="roll_no" required>

        <label>Password</label>
        <input type="password" name="password"
               minlength="6" required>

        <button type="submit" class="btn">
            Create Account
        </button>

    </form>

    <p>Already have an account?
        <a href="login.php">Login here</a>
    </p>
</main>

</body>
</html>
