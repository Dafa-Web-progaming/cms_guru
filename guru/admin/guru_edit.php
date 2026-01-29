<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM guru WHERE id='$id'");
$guru = mysqli_fetch_assoc($data);

if (!$guru) {
    echo "Data guru tidak ditemukan";
    exit;
}

// PROSES UPDATE
if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $nip   = $_POST['nip'];
    $mapel = $_POST['mapel'];

    $update = mysqli_query($conn, "
        UPDATE guru SET
        nama='$nama',
        nip='$nip',
        mata_pelajaran='$mapel'
        WHERE id='$id'
    ");

    if ($update) {
        echo "<script>
            alert('Data guru berhasil diperbarui');
            window.location='dashboard.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border-radius: 12px;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark fw-bold">
                    ✏️ Edit Data Guru
                </div>

                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Guru</label>
                            <input type="text" name="nama" class="form-control"
                                   value="<?= $guru['nama']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control"
                                   value="<?= $guru['nip']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mata Pelajaran</label>
                            <input type="text" name="mapel" class="form-control"
                                   value="<?= $guru['mata_pelajaran']; ?>" required>
                        </div>

                        <button type="submit" name="update" class="btn btn-warning w-100">
                            💾 Simpan Perubahan
                        </button>
                    </form>

                    <a href="dashboard.php" class="btn btn-secondary w-100 mt-3">
                        ⬅️ Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
