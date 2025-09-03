<?php
session_start();
$conn = new mysqli("localhost", "root", "", "thriftin");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];
$userType = $_POST['userType'];

if ($userType === 'admin') {
    // NOTE: Only use this if admin passwords are stored in plain text (not recommended)
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['admin'] = $email;
        header("Location: admin_dash.html");
        exit;
    } else {
        echo "<script>alert('Invalid admin credentials');window.location.href='login_page.html';</script>";
        exit;
    }

    $stmt->close();
}

elseif ($userType === 'seller') {
    $stmt = $conn->prepare("SELECT * FROM sellers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $seller = $result->fetch_assoc();
        if (password_verify($password, $seller['password_hash'])) {
            $_SESSION['seller'] = $email;
            header("Location: seller_dashboard.html"); // Replace with your actual seller dashboard
            exit;
        }
    }

    echo "<script>alert('Invalid seller credentials');window.location.href='login_page.html';</script>";
    exit;
}

elseif ($userType === 'user') {
    $stmt = $conn->prepare("SELECT * FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user'] = $email;
            header("Location: 2nd_street_india.html"); // homepage
            exit;
        }
    }

    echo "<script>alert('Invalid customer credentials');window.location.href='login_page.html';</script>";
    exit;
}

$conn->close();
?>
