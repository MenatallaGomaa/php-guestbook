<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Homebrew usually sets no root password
$dbname = "guestbook_db";

// Connect
$conn = new mysqli($servername, $username, $password, $dbname);

// Check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $message);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit();
    }
}

// Fetch messages
$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Guestbook</title>
</head>
<body>
    <h1>Guestbook</h1>

    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required><br><br>
        <textarea name="message" placeholder="Your Message" required></textarea><br><br>
        <button type="submit">Submit</button>
    </form>

    <hr>
    <h2>Messages</h2>
    <?php while ($row = $result->fetch_assoc()): ?>
        <p>
            <strong><?php echo htmlspecialchars($row['name']); ?>:</strong>
            <?php echo htmlspecialchars($row['message']); ?><br>
            <small><?php echo $row['created_at']; ?></small>
        </p>
        <hr>
    <?php endwhile; ?>
</body>
</html>
