<?php
$conn = new mysqli("localhost", "root", "", "thriftin");
$id = $_POST['id'];
$action = $_POST['action'];

if ($action === "approve") {
    $conn->query("UPDATE products SET status='approved' WHERE id='$id'");
} elseif ($action === "reject") {
    $conn->query("UPDATE products SET status='rejected' WHERE id='$id'");
}
header("Location: admin_dashboard.php");
?>
