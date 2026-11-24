<!DOCTYPE html>
<html>
<head>
    <title>TechPlug - Home</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
        }

        header {
            background: #172554;
            color: white;
            padding: 25px;
            text-align: center;
        }

        nav {
            background: #1e3a8a;
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 15px;
        }

        .container {
            width: 90%;
            margin: 30px auto;
            text-align: center;
        }

        .categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .category-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        .category-card h3 {
            color: #172554;
        }

        .button {
            display: inline-block;
            background: #1e3a8a;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        footer {
            background: #172554;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

<header>
    <h1>TechPlug</h1>
    <p>Your one-stop electronics store</p>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="#categories">Categories</a>
    <a href="products.php">Products</a>
</nav>

<div class="container">

    <h2>Our Products</h2>

    <p>Explore our range of electronics and accessories.</p>

    <div class="categories" id="categories">

        <div class="category-card">
            <h3>Smartphones</h3>
            <p>Discover the latest smartphones.</p>

            <a href="products.php?category=Smartphones" class="button">
                View Products
            </a>
        </div>

        <div class="category-card">
            <h3>Laptops</h3>
            <p>Find laptops for work and study.</p>

            <a href="products.php?category=Laptops" class="button">
                View Products
            </a>
        </div>

        <div class="category-card">
            <h3>Accessories</h3>
            <p>Explore useful tech accessories.</p>

            <a href="products.php?category=Accessories" class="button">
                View Products
            </a>
        </div>

    </div>

</div>

<footer>
    <p>&copy; 2026 TechPlug. All Rights Reserved.</p>
</footer>

</body>
</html>