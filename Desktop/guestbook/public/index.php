<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Homebrew usually sets no root password
$dbname = "guestbook_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM messages WHERE id = $id");
    header("Location: index.php");
    exit();
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $message = trim($_POST['message']);

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guestbook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 700px;
            margin-top: 50px;
        }
        .message-box {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
        }
        .delete-btn {
            position: absolute;
            top: 8px;
            right: 10px;
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
        .delete-btn:hover {
            color: darkred;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">Guestbook</h2>

    <!-- Form -->
    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
            <div class="invalid-feedback">Please enter your name.</div>
        </div>
        <div class="mb-3">
            <textarea name="message" class="form-control" placeholder="Your Message" rows="3" required></textarea>
            <div class="invalid-feedback">Please enter a message.</div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>

    <hr class="my-4">

    <h4>Messages</h4>
    <?php while ($row = $result->fetch_assoc()): ?>
<div class="message-box">
    <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn">
    <img src="/delete.png" alt="Delete" width="18" height="18"></a>
    <strong><?php echo htmlspecialchars($row['name']); ?>:</strong>
    <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
    <small class="text-muted"><?php echo $row['created_at']; ?></small>
</div>
    <?php endwhile; ?>
</div>

<script>
    // Enable bootstrap validation feedback
    (() => {
        'use strict';
        const forms = document.querySelectorAll('form');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    // Allow "Enter" to submit the form (Shift+Enter for new line)
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector("form");
        const messageBox = document.querySelector("textarea");

        messageBox.addEventListener("keydown", function(e) {
            if (e.key === "Enter" && !e.shiftKey) {
                e.preventDefault(); // prevent new line
                form.submit(); // submit the form
            }
        });
    });
</script>

</body>
</html>
