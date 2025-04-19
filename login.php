<body>
  <div class="container">
    <?php
		session_start(); // Start the session to use session variables
		require_once 'db.php'; // Include database connection

		// Show flash message if one exists
		if (isset($_SESSION['message'])) {
			echo "<p style='color: green;'>{$_SESSION['message']}</p>";
			unset($_SESSION['message']); // Remove message after displaying it
		}

		// Handle login form submission
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Prepare SQL query to get user id and hashed password based on entered username
			$stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");
			$stmt->bind_param("s", $_POST['username']); // Bind submitted username to the query
			$stmt->execute(); // Execute the query
			$stmt->bind_result($id, $hash); // Bind the result columns to variables
			
			// Check if a user was found and password matches
			if ($stmt->fetch() && password_verify($_POST['password'], $hash)) {
				$_SESSION['user_id'] = $id; // Store user ID in session to keep them logged in
				$_SESSION['message'] = "Welcome back!"; // Set welcome message
				header("Location: index.php"); // Redirect to main page after login
				exit; // Stop script execution
			} else {
				// Display error if login fails
				echo "<p style='color: red;'>Login failed. Please try again.</p>";
			}
		}
		?>
		<head>
		  <link rel="stylesheet" href="styles.css">
		</head>
		<h2>Login</h2>
		<form method="POST">
		  Username: <input name="username" required><br>
		  Password: <input type="password" name="password" required><br>
		  <button type="submit">Login</button>
		</form>

		<p>Don't have an account? <a href="register.php">Register here</a></p>
  </div>
</body>