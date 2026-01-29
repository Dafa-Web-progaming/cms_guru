<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            width: 420px;
            border-radius: 14px;
            border: none;
            box-shadow: 0 15px 40px rgba(0,0,0,.1);
        }

        .card-header {
            background: #0d6efd;
            color: white;
            text-align: center;
            border-radius: 14px 14px 0 0;
        }

        .btn-success {
            border-radius: 10px;
        }

        /* DARK MODE SUPPORT */
        body.dark {
            background: linear-gradient(135deg, #0f172a, #020617);
            color: #e5e7eb;
        }

        body.dark .card {
            background: #020617;
            color: #e5e7eb;
        }

        body.dark .form-control {
            background: #020617;
            color: #e5e7eb;
            border-color: #334155;
        }

        body.dark .form-control::placeholder {
            color: #94a3b8;
        }
    </style>
</head>

<body>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">➕ Tambah Data Guru</h5>
    </div>

    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Guru</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama guru" required>
            </div>

            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mata Pelajaran</label>
                <input type="text" name="mapel" class="form-control" placeholder="Contoh: Matematika" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" name="simpan" class="btn btn-success">
                    💾 Simpan Guru
                </button>
                <a href="dashboard.php" class="btn btn-outline-secondary">
                    ⬅ Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>
</div>

<?php
// PROSES SIMPAN
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $nip  = $_POST['nip'];
    $mapel = $_POST['mapel'];

    $insert = mysqli_query($conn, "
        INSERT INTO guru (nama, nip, mata_pelajaran)
        VALUES ('$nama', '$nip', '$mapel')
    ");

    if ($insert) {
        echo "<script>
            alert('Data guru berhasil ditambahkan');
            window.location='dashboard.php';
        </script>";
    }
}
?>

<script>
// Sinkron dengan dark mode dashboard
if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark");
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
