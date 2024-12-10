<?php
// Start session
session_start();

print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velvet Vogue - Join</title>
    <link rel="stylesheet" href="Join.css">
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav class="navbar">
            <div class="logo"><b><a href="index.php">Velvet Vogue</a></b></div>
            <div class="nav_menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="accessories.html">Accessories</a></li>
                    <li><a href="support.html">Support</a></li>
                    <li id="join-profile">
                        <?php if (isset($_SESSION['username'])): ?>
                            <a href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                        <?php else: ?>
                            <a class="active" href="join.php">Join</a>
                        <?php endif; ?>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Container for Login and Registration Forms -->
    <div class="container">
        <!-- Login Form -->
        <div class="form-box" id="login" style="<?php echo isset($_SESSION['username']) ? 'display:none;' : 'display:block;'; ?>">
            <h2>Login</h2>
            <form class="login-form" action="login.php" method="POST">
                <div class="input-group">
                    <label for="login-username">Username</label>
                    <input type="text" id="login-username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" required>
                </div>
                <button type="submit">Login</button>
                <p class="message">Don't have an account? <a href="#" onclick="toggleForm('register')">Sign Up</a></p>
            </form>
        </div>

        <!-- Registration Form -->
        <div class="form-box" id="register" style="display:none;">
            <h2>Sign Up</h2>
            <form class="register-form" action="register.php" method="POST">
                <div class="input-group">
                    <label for="register-username">Username</label>
                    <input type="text" id="register-username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" name="password" required>
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <button type="submit">Register</button>
                <p class="message">Already have an account? <a href="#" onclick="toggleForm('login')">Login</a></p>
            </form>
        </div>
    </div>

    <script>
        // Toggle between login and registration forms
        function toggleForm(form) {
            document.getElementById('login').style.display = form === 'login' ? 'block' : 'none';
            document.getElementById('register').style.display = form === 'register' ? 'block' : 'none';
        }
    </script>
    <script src="script.js"></script>
</body>
</html>
