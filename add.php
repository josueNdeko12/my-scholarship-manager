<body>
  <div class="container">
    <?php
		session_start();
		if (!isset($_SESSION['user_id'])) {
			header("Location: login.php");
			exit;
		}
		require_once 'db.php';

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$stmt = $conn->prepare("INSERT INTO scholarships (user_id, name, organization, amount, deadline, url, notes)
									VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("issdsss", $_SESSION['user_id'], $_POST['name'], $_POST['org'], $_POST['amount'],
							  $_POST['deadline'], $_POST['url'], $_POST['notes']);
			$stmt->execute();

			$_SESSION['message'] = "Scholarship added successfully!";
			header("Location: index.php");
			exit;
		}
		?>
		<head>
		  <link rel="stylesheet" href="styles.css">
		</head>
		<h2>Add Scholarship</h2>
		<form method="POST">
		  Name: <input name="name" required><br>
		  Organization: <input name="org"><br>
		  Amount: <input name="amount" type="number" step="0.01"><br>
		  Deadline: <input name="deadline" type="date"><br>
		  URL: <input name="url"><br>
		  Notes: <textarea name="notes"></textarea><br>
		  <button type="submit">Save</button>
		</form>
  </div>
</body>