<?php
include '../includes/db.php';
include '../includes/header.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<h2 class="text-center">User  Profile</h2>
<div class="card">
    <div class="card-body">
        <p>Username: <strong><?php echo htmlspecialchars($user['username']); ?></strong></p>
        <p>Email: <strong><?php echo htmlspecialchars($user['email']); ?></strong></p>
        <p>Role: <strong><?php echo htmlspecialchars($user['role']); ?></strong></p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>