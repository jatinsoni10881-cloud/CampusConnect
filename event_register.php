<?php
session_start();
require_once "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['event_id'])) {

    $user_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];

    $sql = "INSERT INTO registrations (user_id, event_id)
            VALUES (?, ?)";

    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$user_id, $event_id]);

        echo "Event Registration Successful!";
        echo "<br><a href='index.php'>Go to Home</a>";

    } catch (PDOException $e) {

        echo "You have already registered for this event.";
        echo "<br><a href='index.php'>Go to Home</a>";
    }

} else {
    echo "Invalid Request";
}
?>