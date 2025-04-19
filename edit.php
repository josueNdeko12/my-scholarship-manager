<body>
  <div class="container">
    <?php
		session_start(); // Start the session to access session variables

		// Redirect to login page if user is not logged in
		if (!isset($_SESSION['user_id'])) {
			header("Location: login.php");
			exit;
		}

		require_once 'db.php'; // Include database connection

		// Get the scholarship ID from the URL
		$id = $_GET['id'];

		// Fetch the scholarship record for the current user
		$stmt = $conn->prepare("SELECT * FROM scholarships WHERE id = ? AND user_id = ?");
		$stmt->bind_param("ii", $id, $_SESSION['user_id']);
		$stmt->execute();
		$row = $stmt->get_result()->fetch_assoc();

		// If the scholarship doesn't exist or doesn't belong to the user
		if (!$row) {
			$_SESSION['message'] = "Scholarship not found or access denied.";
			header("Location: index.php");
			exit;
		}

		// Handle form submission for updating the scholarship
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$stmt = $conn->prepare("UPDATE scholarships SET name=?, organization=?, amount=?, deadline=?, url=?, notes=? WHERE id=? AND user_id=?");
			$stmt->bind_param("ssdssssi", $_POST['name'], $_POST['org'], $_POST['amount'], $_POST['deadline'],
							  $_POST['url'], $_POST['notes'], $id, $_SESSION['user_id']);
			$stmt->execute();

			$_SESSION['message'] = "Scholarship updated."; // Set a success message
			header("Location: index.php"); // Redirect to the main page
			exit;
		}
		?>
		<head>
		  <link rel="stylesheet" href="styles.css">
		</head>
		<h2>Edit Scholarship</h2>
		<form method="POST">
		  Name: <input name="name" value="<?= $row['name'] ?>" required><br>
		  Organization: <input name="org" value="<?= $row['organization'] ?>"><br>
		  Amount: <input name="amount" type="number" step="0.01" value="<?= $row['amount'] ?>"><br>
		  Deadline: <input name="deadline" type="date" value="<?= $row['deadline'] ?>"><br>
		  URL: <input name="url" value="<?= $row['url'] ?>"><br>
		  Notes: <textarea name="notes"><?= $row['notes'] ?></textarea><br>
		  <button type="submit">Update</button>
		</form>
  </div>
</body>