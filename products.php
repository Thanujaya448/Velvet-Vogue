<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "velvet_vogue";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $imagePath = "uploads/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update product
        $id = $_POST['id'];
        if (!empty($imagePath)) {
            $stmt = $conn->prepare("UPDATE products SET title=?, image=?, category=?, description=?, price=? WHERE id=?");
            $stmt->bind_param("ssssdi", $title, $imagePath, $category, $description, $price, $id);
        } else {
            $stmt = $conn->prepare("UPDATE products SET title=?, category=?, description=?, price=? WHERE id=?");
            $stmt->bind_param("sssdi", $title, $category, $description, $price, $id);
        }
        $stmt->execute();
    } else {
        // Add new product
        $stmt = $conn->prepare("INSERT INTO products (title, image, category, description, price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $title, $imagePath, $category, $description, $price);
        $stmt->execute();
    }
    header("Location: admin.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

$products = $conn->query("SELECT * FROM products");
if (!$products) {
    die("Error fetching products: " . $conn->error);
}

$conn->close();
?>
