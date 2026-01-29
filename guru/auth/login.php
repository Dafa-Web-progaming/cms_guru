<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: ../admin/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login CMS Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card shadow" style="width: 350px;">
        <div class="card-body">
            <h4 class="text-center mb-3">Login CMS Guru</h4>

            <form method="POST" action="login_proses.php">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>


</body>
</html>
