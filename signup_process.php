<?php
/*
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userType = $_POST['userType'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $state = $_POST['country'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;
    $terms = isset($_POST['terms']) ? 1 : 0;

    // Hash the password
    $passwordHash = password_hash($POST['password'], PASSWORD_DEFAULT);

    if ($userType === 'user') {
        $stmt = $pdo->prepare("INSERT INTO customers (first_name, last_name, email, phone, state, city, password_hash, newsletter_opt_in, terms_accepted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    } elseif ($userType === 'seller') {
        $stmt = $pdo->prepare("INSERT INTO sellers (first_name, last_name, email, phone, state, city, password_hash, newsletter_opt_in, terms_accepted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    } elseif ($userType === 'admin') {
        $stmt = $pdo->prepare("INSERT INTO admin (email, password_hash) VALUES (?, ?)");
        $stmt->execute([$email, $passwordHash]);
        header("Location: login_page.html");
        exit();
    } else {
        die("Invalid user type selected.");
    }

    $stmt->execute([$firstName, $lastName, $email, $phone, $state, $city, $passwordHash, $newsletter, $terms]);

    header("Location: login_page.html");
    exit();
}
    */
// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = ""; // change if needed
$dbname = "thriftIN"; // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize inputs
$firstName = $conn->real_escape_string($_POST['firstName']);
$lastName = $conn->real_escape_string($_POST['lastName']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$state = $conn->real_escape_string($_POST['country']);
$city = $conn->real_escape_string($_POST['city']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // secure
$userType = $_POST['userType'];

// Determine which table to insert into
if ($userType === 'user') {
    $sql = "INSERT INTO customers (first_name, last_name, email, phone, state, city, password) 
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$state', '$city', '$password')";
} else {
    if ($userType === 'seller') {
    $stmt = $conn->prepare("INSERT INTO sellers (first_name, last_name, email, phone, state, city, password_hash, newsletter_opt_in, terms_accepted, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssssssis", $firstName, $lastName, $email, $phone, $state, $city, $passwordHash, $newsletter, $terms);
}
}

if ($conn->query($sql) === TRUE) {
    header("Location: signup_success.html");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
