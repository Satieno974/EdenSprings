<?php
session_start();
include 'db.php';

$cart_products = [];
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', $_SESSION['cart']);
    $result = $db->query("SELECT * FROM products WHERE id IN ($ids)");

    while ($product = $result->fetch_assoc()) {
        $cart_products[] = $product;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
</head>
<body>
<h1>Your Cart</h1>
<?php if ($cart_products): ?>
    <ul>
        <?php foreach ($cart_products as $product): ?>
            <li><?php echo $product['name']; ?> - $<?php echo $product['price']; ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Total: $<?php echo array_sum(array_column($cart_products, 'price')); ?></p>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>
</body>
</html>
