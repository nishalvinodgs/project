<?php
session_start();

// 1. DB Connection
$conn = new mysqli("localhost", "root", "", "thriftin");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Collect and sanitize POST data
$title = $_POST['title'];
$price = $_POST['price'];
$original_price = $_POST['original_price'];
$category = $_POST['category'];
$condi = $_POST['condi']; // from form
$descrip = $_POST['descript'];
$seller_id = $_POST['seller_id']; // can also be $_SESSION['seller_id']
$status = "Available"; // Default
$created_at = date("Y-m-d H:i:s");

// 3. Handle file upload
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$image_name = basename($_FILES["image"]["name"]);
$target_file = $target_dir . time() . "_" . $image_name;
$image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Optional: Validate file type (optional but recommended)
$allowed_types = ["jpg", "jpeg", "png", "gif"];
if (!in_array($image_type, $allowed_types)) {
    echo "<script>alert('Invalid image format. Only JPG, PNG, and GIF are allowed.'); window.history.back();</script>";
    exit;
}

// Move uploaded image
if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "<script>alert('Failed to upload image.'); window.history.back();</script>";
    exit;
}

// 4. Insert into `products` table
$stmt = $conn->prepare("
    INSERT INTO products (seller_id, title, price, original_price, category, condi, descript, image, status, created_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("isddssssss", $seller_id, $title, $price, $original_price, $category, $condi, $descrip, $target_file, $status, $created_at);

if ($stmt->execute()) {
    echo "<script>alert('Product uploaded successfully!'); window.location.href='seller_dashboard.html';</script>";
} else {
    echo "<script>alert('Error uploading product: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
