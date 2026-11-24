<?php

require_once "db.php";

// Get filter values
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$sort = $_GET['sort'] ?? '';

// Pagination
$productsPerPage = 4;
$currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Search and category conditions
$searchTerm = "%" . $search . "%";

// Count matching products
$countQuery = "SELECT COUNT(*) AS total FROM products
               WHERE (? = '' OR name LIKE ?)
               AND (? = '' OR category = ?)";

$countStmt = $conn->prepare($countQuery);
$countStmt->bind_param("ssss", $search, $searchTerm, $category, $category);
$countStmt->execute();

$countResult = $countStmt->get_result();
$totalProducts = $countResult->fetch_assoc()['total'];

$totalPages = max(1, ceil($totalProducts / $productsPerPage));
$currentPage = min($currentPage, $totalPages);

$offset = ($currentPage - 1) * $productsPerPage;

// Sorting
$orderBy = "id ASC";

if ($sort === "low") {
    $orderBy = "price ASC";
} elseif ($sort === "high") {
    $orderBy = "price DESC";
}

// Retrieve products from database
$query = "SELECT * FROM products
          WHERE (? = '' OR name LIKE ?)
          AND (? = '' OR category = ?)
          ORDER BY $orderBy
          LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);
$stmt->bind_param(
    "ssssii",
    $search,
    $searchTerm,
    $category,
    $category,
    $productsPerPage,
    $offset
);

$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>TechPlug - Products</title>

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
            width: 90%;
            margin: 25px auto;
        }

        .filters {
            background: white;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 8px;
        }

        input, select, button {
            padding: 10px;
            margin: 5px;
        }

        button {
            background: #1e3a8a;
            color: white;
            border: none;
            cursor: pointer;
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .product-card img {
            width: 100%;
            height: 170px;
            object-fit: contain;
        }

        .product-card h3 {
            color: #172554;
        }

        .price {
            color: green;
            font-weight: bold;
        }

        .details-button {
            display: inline-block;
            background: #1e3a8a;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination {
            text-align: center;
            margin: 30px 0;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 10px 15px;
            margin: 4px;
            background: #1e3a8a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination .active {
            background: #16a34a;
        }

        .pagination .disabled {
            background: #999;
        }

        footer {
            background: #172554;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
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

    <h2>Our Product Catalogue</h2>

    <div class="filters">

        <form method="GET" action="products.php">

            <input
                type="text"
                name="search"
                placeholder="Search products..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <select name="category">

                <option value="">All Categories</option>

                <option value="Smartphones"
                    <?php if ($category === "Smartphones") echo "selected"; ?>>
                    Smartphones
                </option>

                <option value="Laptops"
                    <?php if ($category === "Laptops") echo "selected"; ?>>
                    Laptops
                </option>

                <option value="Accessories"
                    <?php if ($category === "Accessories") echo "selected"; ?>>
                    Accessories
                </option>

            </select>

            <select name="sort">

                <option value="">Sort Products</option>

                <option value="low"
                    <?php if ($sort === "low") echo "selected"; ?>>
                    Price: Low to High
                </option>

                <option value="high"
                    <?php if ($sort === "high") echo "selected"; ?>>
                    Price: High to Low
                </option>

            </select>

            <button type="submit">Apply Filters</button>

            <a href="products.php">Clear Filters</a>

        </form>

    </div>

    <p>
        Showing <?php echo $result->num_rows; ?>
        of <?php echo $totalProducts; ?> products.
    </p>

    <div class="product-container">

        <?php if ($result->num_rows > 0): ?>

            <?php while ($product = $result->fetch_assoc()): ?>

                <div class="product-card">

                    <img
                        src="<?php echo htmlspecialchars($product['image']); ?>"
                        alt="<?php echo htmlspecialchars($product['name']); ?>"
                    >

                    <h3>
                        <?php echo htmlspecialchars($product['name']); ?>
                    </h3>

                    <p>
                        Category:
                        <?php echo htmlspecialchars($product['category']); ?>
                    </p>

                    <p class="price">
                        KSh <?php echo number_format($product['price']); ?>
                    </p>

                    <a
                        class="details-button"
                        href="product_details.php?id=<?php echo $product['id']; ?>"
                    >
                        View Details
                    </a>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <p>No products found. Try a different search.</p>

        <?php endif; ?>

    </div>

    <?php if ($totalPages > 1): ?>

        <div class="pagination">

            <?php if ($currentPage > 1): ?>

                <a href="?<?php echo http_build_query([
                    'search' => $search,
                    'category' => $category,
                    'sort' => $sort,
                    'page' => $currentPage - 1
                ]); ?>">Previous</a>

            <?php else: ?>

                <span class="disabled">Previous</span>

            <?php endif; ?>

            <?php for ($page = 1; $page <= $totalPages; $page++): ?>

                <?php if ($page == $currentPage): ?>

                    <span class="active"><?php echo $page; ?></span>

                <?php else: ?>

                    <a href="?<?php echo http_build_query([
                        'search' => $search,
                        'category' => $category,
                        'sort' => $sort,
                        'page' => $page
                    ]); ?>">
                        <?php echo $page; ?>
                    </a>

                <?php endif; ?>

            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>

                <a href="?<?php echo http_build_query([
                    'search' => $search,
                    'category' => $category,
                    'sort' => $sort,
                    'page' => $currentPage + 1
                ]); ?>">Next</a>

            <?php else: ?>

                <span class="disabled">Next</span>

            <?php endif; ?>

        </div>

    <?php endif; ?>

</div>

<footer>
    <p>&copy; 2026 TechPlug. All Rights Reserved.</p>
</footer>

</body>
</html>