<?php
require __DIR__ . '/config.php';  

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $message);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: public/index.php");
exit();
