<?php

require_once "db.php";

// Get product ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid product ID.");
}

$productId = (int) $_GET['id'];

// Retrieve product from database
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>

    <title><?php echo htmlspecialchars($product['name']); ?> - TechPlug</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
        }

        header {
            background: #172554;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            background: #1e3a8a;
            padding: 12px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 15px;
        }

        .container {
            width: 80%;
            margin: 40px auto;
        }

        .product-details {
            background: white;
            padding: 30px;
            border-radius: 8px;
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .product-details img {
            width: 45%;
            max-height: 350px;
            object-fit: contain;
        }

        .information {
            flex: 1;
        }

        .information h2 {
            color: #172554;
        }

        .price {
            color: green;
            font-size: 24px;
            font-weight: bold;
        }

        .back-button {
            display: inline-block;
            background: #1e3a8a;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        footer {
            background: #172554;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }

        @media (max-width: 650px) {
            .product-details {
                flex-direction: column;
            }

            .product-details img {
                width: 100%;
            }
        }

    </style>

</head>

<body>

<header>
    <h1>TechPlug</h1>
    <p>Explore our electronics collection</p>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
</nav>

<div class="container">

    <div class="product-details">

        <img
            src="<?php echo htmlspecialchars($product['image']); ?>"
            alt="<?php echo htmlspecialchars($product['name']); ?>"
        >

        <div class="information">

            <h2>
                <?php echo htmlspecialchars($product['name']); ?>
            </h2>

            <p>
                <strong>Category:</strong>
                <?php echo htmlspecialchars($product['category']); ?>
            </p>

            <p>
                <?php echo htmlspecialchars($product['description']); ?>
            </p>

            <p class="price">
                KSh <?php echo number_format($product['price']); ?>
            </p>

            <a href="products.php" class="back-button">
                Back to Products
            </a>

        </div>

    </div>

</div>

<footer>
    <p>&copy; 2026 TechPlug. All Rights Reserved.</p>
</footer>

</body>
</html>