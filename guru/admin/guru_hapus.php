<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Ambil ID guru dari URL
$id = $_GET['id'];

if (!$id) {
    header("Location: dashboard.php");
    exit;
}

// Hapus guru
$hapus = mysqli_query($conn, "DELETE FROM guru WHERE id='$id'");

if ($hapus) {
    echo "<script>
            alert('Data guru berhasil dihapus');
            window.location='dashboard.php';
          </script>";
} else {
    echo "Gagal menghapus data guru";
}
