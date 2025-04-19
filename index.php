<body>
  <div class="container">
    <?php
		session_start();
		if (!isset($_SESSION['user_id'])) {
			header("Location: login.php");
			exit;
		}
		require_once 'db.php';
		?>

		<!DOCTYPE html>
		<html>
		<head>
			<title>Your Scholarships</title>
			<link rel="stylesheet" href="styles.css">
		</head>
		<body>

		<?php
		// Flash message
		if (isset($_SESSION['message'])) {
			echo "<p class='success-message'>{$_SESSION['message']}</p>";
			unset($_SESSION['message']);
		}

		$userId = $_SESSION['user_id'];
		$stmt = $conn->prepare("SELECT * FROM scholarships WHERE user_id = ?");
		$stmt->bind_param("i", $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		?>

		<h2>Your Scholarships</h2>
		<p>
		  <a href="add.php">Add Scholarship</a> |
		  <a href="logout.php">Logout</a>
		</p>

		<?php
		while ($row = $result->fetch_assoc()) {
			echo "<div style='margin-bottom: 15px;'>
					<strong>{$row['name']}</strong> – {$row['deadline']}<br>
					<a href='edit.php?id={$row['id']}'>Edit</a>
					<a href='delete.php?id={$row['id']}'>Delete</a>
				  </div>";
		}
		?>

		</body>
		</html>
  </div>
</body>