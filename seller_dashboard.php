<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller Dashboard - thriftIN</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #000;
      color: #fff;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .header {
      width: 100%;
      background: rgba(0, 0, 0, 0.9);
      backdrop-filter: blur(10px);
      z-index: 1000;
      padding: 15px 0;
      position: sticky;
      top: 0;
    }

    .nav-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
    }

    .logo-container {
      display: flex;
      align-items: center;
    }

    .logo-img {
      height: 80px;
      width: auto;
    }

    .logo-text {
      font-size: 25px;
      font-weight: bold;
      color: #fff;
      text-decoration: none;
      animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
      from { text-shadow: 0 0 5px #fff, 0 0 10px #fff; }
      to { text-shadow: 0 0 10px #fff, 0 0 20px #fff; }
    }

    .nav-menu {
      display: flex;
      list-style: none;
      gap: 30px;
    }

    .nav-menu a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
    }

    .nav-menu a:hover {
      color: #ccc;
      transform: translateY(-2px);
    }

    .nav-menu a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -5px;
      left: 0;
      background: #fff;
      transition: width 0.3s ease;
    }

    .nav-menu a:hover::after {
      width: 100%;
    }

    .admin-main {
      display: flex;
      flex: 1;
    }

    .sidebar {
      width: 250px;
      background: #1a1a1a;
      padding: 20px;
      border-right: 1px solid #333;
    }

    .sidebar h3 {
      color: #ff6b35;
      margin-bottom: 20px;
      text-align: center;
    }

    .sidebar ul {
      list-style: none;
    }

    .sidebar ul li {
      margin-bottom: 10px;
    }

    .sidebar ul li a {
      display: block;
      padding: 12px 15px;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.3s ease, color 0.3s ease;
    }

    .sidebar ul li a:hover,
    .sidebar ul li a.active {
      background: #ff6b35;
      color: #000;
    }

    .content-area {
      flex: 1;
      padding: 30px;
      background: #0a0a0a;
    }

    form input, form select, form textarea, form button {
      display: block;
      width: 100%;
      margin-bottom: 15px;
      padding: 10px;
      background: #111;
      border: 1px solid #333;
      color: #fff;
      border-radius: 8px;
    }

    form button {
      background: #ff6b35;
      color: #000;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    form button:hover {
      background: #e05a2a;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table th, table td {
      border: 1px solid #333;
      padding: 10px;
      text-align: left;
    }

    table th {
      background: #222;
      color: #ff6b35;
    }

    table tr:nth-child(even) {
      background: #111;
    }

    table tr:hover {
      background: #1a1a1a;
    }

    @media (max-width: 768px) {
      .admin-main {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid #333;
      }
    }
  </style>
  <script>
    function scrollToSection(id) {
      document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
    }
  </script>
</head>
<body>
  <header class="header">
    <div class="nav-container">
      <div class="logo-container">
        <img src="logo1.png" alt="Logo" class="logo-img">
        <a href="index.html" class="logo-text">thriftIN</a>
      </div>
      <nav>
        <ul class="nav-menu">
          <li><a href="#">Seller Panel</a></li>
          <li><a href="login_page.html">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="admin-main">
    <aside class="sidebar">
      <h3>Seller Navigation</h3>
      <ul>
        <li><a href="#" class="active" onclick="scrollToSection('upload-section')">Upload Product</a></li>
        <li><a href="#" onclick="scrollToSection('my-products')">My Products</a></li>
        <li><a href="#" onclick="scrollToSection('orders')">Orders</a></li>
      </ul>
    </aside>

    <main class="content-area">
      <section id="upload-section">
        <h2>Upload New Product</h2>
        <form action="upload_product.php" method="POST" enctype="multipart/form-data">
          <input type="text" name="title" placeholder="Product Title" required>
          <input type="number" name="price" placeholder="Selling Price" required>
          <input type="number" name="original_price" placeholder="Original Price">
          <select name="category" required>
            <option value="">Select Category</option>
            <option value="watches">Watches</option>
            <option value="shoes">Shoes</option>
            <option value="bags">Luxury Bags</option>
            <option value="gaming">Gaming</option>
            <option value="gadgets">Gadgets</option>
          </select>
          <select name="condition" required>
            <option value="">Select Condition</option>
            <option value="new">New</option>
            <option value="like-new">Like New</option>
            <option value="good">Good</option>
            <option value="fair">Fair</option>
          </select>
          <textarea name="description" placeholder="Description"></textarea>
          <input type="file" name="image" required>
        <input type="hidden" name="seller_id" value="<?php echo $_SESSION['seller_id']; ?>">

          <button type="submit">Upload Product</button>
        </form>
      </section>

      <section id="my-products">
        <h2>My Products</h2>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Product</th>
              <th>Category</th>
              <th>Price</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            session_start();
            $conn = new mysqli("localhost", "root", "", "thriftin");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get seller ID from session
            $seller_email = $_SESSION['seller'] ?? null;

            if ($seller_email) {
                // Get seller_id using email
                $stmt = $conn->prepare("SELECT id FROM sellers WHERE email = ?");
                $stmt->bind_param("s", $seller_email);
                $stmt->execute();
                $result = $stmt->get_result();
                $seller = $result->fetch_assoc();
                $seller_id = $seller['id'];

                // Fetch products uploaded by this seller
                $stmt = $conn->prepare("SELECT * FROM products WHERE seller_id = ? ORDER BY created_at DESC");
                $stmt->bind_param("i", $seller_id);
                $stmt->execute();
                $products = $stmt->get_result();

                if ($products->num_rows > 0) {
                    while ($row = $products->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['category']}</td>";
                        echo "<td>₹{$row['price']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "<td>
                                <form action='edit_product.php' method='GET' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit'>Edit</button>
                                </form>
                                <form action='delete_product.php' method='POST' onsubmit=\"return confirm('Delete this product?');\" style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No products found.</td></tr>";
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "<tr><td colspan='6'>You must be logged in to see your products.</td></tr>";
            }
            ?>
            </tbody>

        </table>
      </section>

      <section id="orders">
        <h2>Orders</h2>
        <table>
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Product</th>
              <th>Buyer</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>5001</td>
              <td>Luxury Handbag</td>
              <td>john@example.com</td>
              <td>Shipped</td>
              <td>
                <button>View</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>
</html>
