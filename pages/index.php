<?php
include '../includes/db.php';
include '../includes/header.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: profile.php");
        exit();
    } else {
        echo "<p class='alert alert-danger'>Invalid username or password.</p>";
    }
}
?>

<h2 class="text-center">Login</h2>
<form method="POST" action="">
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Login</button>
</form>

<?php include '../includes/footer.php'; ?>