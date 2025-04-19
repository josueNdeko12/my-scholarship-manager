<body>
  <div class="container">
    <?php
		session_start(); // Start the session to access session variables

		// Display a success message if one exists in the session, then remove it
		if (isset($_SESSION['message'])) {
			echo "<p style='color: green;'>{$_SESSION['message']}</p>";
			unset($_SESSION['message']);
		}

		require_once 'db.php'; // Include database connection

		// If the form was submitted via POST
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = $_POST['username']; // Get submitted username
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for secure storage

			// Prepare SQL statement to insert user into the users table
			$stmt = $conn->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
			$stmt->bind_param("ss", $username, $password); // Bind parameters to the SQL query
			$stmt->execute(); // Execute the SQL query

			header("Location: login.php"); // Redirect to login page (this line executes immediately)
			$_SESSION['message'] = "Registration successful. Please log in."; // This line is unreachable due to the redirect above
			header("Location: login.php"); // Duplicate redirect (also unreachable)
			exit; // Stop script execution
		}
		?>
		<head>
		  <link rel="stylesheet" href="styles.css">
		</head>
		<h2>Register</h2>
		<form method="POST">
		  Username: <input name="username" required><br>
		  Password: <input type="password" name="password" required><br>
		  <button type="submit">Register</button>
		</form>

		<p>Already have an account? <a href="login.php">Login here</a></p>
  </div>
</body>