<?php
$conn = new mysqli("localhost", "root", "", "thriftin");
$products = $conn->query("SELECT * FROM products WHERE status = 'pending'");
?>

<h1>Pending Product Approvals</h1>
<?php while ($row = $products->fetch_assoc()) { ?>
  <div>
    <img src="<?= $row['image'] ?>" width="100"><br>
    <strong><?= $row['title'] ?></strong><br>
    ₹<?= $row['price'] ?> (<?= $row['condition'] ?>)<br>
    <form method="POST" action="moderate_product.php">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <button name="action" value="approve">Approve</button>
      <button name="action" value="reject">Reject</button>
    </form>
    <hr>
  </div>
<?php } ?>
