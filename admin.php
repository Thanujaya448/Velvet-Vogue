<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Products</title>
    <link rel="stylesheet" href="admin.css">
    <script defer src="script.js"></script>
</head>
<body>

<!-- Navigation Bar -->
<header>
        <nav class="navbar">
            <div class="logo"><b><a href="index.html">Velvet Vogue</a></b></div>
            <div class="nav_menu">
                <ul>
                    <li><a class="active" href="index.html">Home</a></li>
                    <li><a href="product.php">Products</a></li>
                    <li><a href="accessories.html">Accessories</a></li>
                    <li><a href="support.html">Support</a></li>
                    <li><a href="join.html">Join</a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <div class="container">
        <h1>Admin Panel - Manage Products</h1>

        <!-- Add/Edit Form -->
            <form id="productForm" method="POST" action="products.php" enctype="multipart/form-data">
            <input type="hidden" name="id" id="productId">
            <input type="text" name="title" id="productTitle" placeholder="Product Title" required>
            <input type="text" name="category" id="productCategory" placeholder="Category" required>
            <textarea name="description" id="productDescription" placeholder="Description" required></textarea>
            <input type="number" step="0.01" name="price" id="productPrice" placeholder="Price (e.g., 49.99)" required>
            <input type="file" name="image" id="productImage" accept="image/*">
            <button type="submit">Save Product</button>
            </form>


        <!-- Products Table -->
                        <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'products.php'; // Ensure the path is correct 
                        if ($products && $products->num_rows > 0): ?>
                            <?php while ($row = $products->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($row['image'])): ?>
                                    <img src="<?php echo $row['image']; ?>" alt="Product Image" style="width: 100px; height: auto;">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['category']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td>$<?php echo number_format($row['price'], 2); ?></td>
                                <td>
                                    <button class="editBtn" 
                                        data-id="<?php echo $row['id']; ?>" 
                                        data-title="<?php echo htmlspecialchars($row['title']); ?>" 
                                        data-category="<?php echo htmlspecialchars($row['category']); ?>" 
                                        data-description="<?php echo htmlspecialchars($row['description']); ?>" 
                                        data-price="<?php echo $row['price']; ?>" 
                                        data-image="<?php echo $row['image']; ?>">
                                        Edit
                                    </button>
                                    <a href="products.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
</table>


    </div>
</body>
</html>
