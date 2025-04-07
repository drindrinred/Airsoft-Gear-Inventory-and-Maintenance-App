<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $email, $role);

    if ($stmt->execute()) {
        echo "<p class='alert alert-success'>Registration successful!</p>";
    } else {
        echo "<p class='alert alert-danger'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<h2 class="text-center">Register</h2>
<form method="POST" action="">
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="form-group">
        <select name="role" class="form-control">
            <option value="player">Player</option>
            <option value="employee">Employee</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Register</button>
</form>

<?php include '../includes/footer.php'; ?>