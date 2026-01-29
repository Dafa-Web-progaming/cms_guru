<?php
session_start();
include "../config/database.php";
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php
$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

if ($data && $password == $data['password']) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $data['username'];

    header("Location: ../admin/dashboard.php");
    exit;
} else {
    echo "Login gagal. <a href='login.php'>Coba lagi</a>";
}
