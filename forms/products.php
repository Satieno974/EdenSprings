<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $_SESSION['cart'][] = $_POST['product_id'];
    header("Location: forms/products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Store</h1>
        <nav>
            <a href="forms/login.php">Login</a> | <a href="forms/register.php">Register</a>
            <a href="forms/cart.php">Cart (<?php echo count($_SESSION['cart']); ?>)</a>
        </nav>
    </header>

    <main>
        <h2>Products</h2>
        <section class="products">
            <?php
            $result = $db->query("SELECT * FROM products");

            while ($product = $result->fetch_assoc()):
            ?>
                <div class="product">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Price: $<?php echo $product['price']; ?></p>
                    <form action="forms/products.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </section>
    </main>
</body>
</html>
