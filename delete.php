<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM scholarships WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();

$_SESSION['message'] = "Scholarship deleted.";
header("Location: index.php");
exit;
