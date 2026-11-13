
<?php

$host = "127.0.0.1";
$port = "3306";
$dbname = "campus_event_management";

// Enter your local database credentials here
$username = "YOUR_DB_USERNAME";
$password = "YOUR_DB_PASSWORD";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname",
        $username,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {
    die("Database connection failed.");
}
