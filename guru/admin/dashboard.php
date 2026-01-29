<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$guru = mysqli_query($conn, "SELECT * FROM guru");
$totalGuru = mysqli_num_rows($guru);
$tanggal = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard CMS Guru</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
    padding: 20px;
}
        .card-stat {
            border-left: 5px solid #0d6efd;
        }
        .table thead th {
            vertical-align: middle;
            text-align: center;
        }
        .table td {
            vertical-align: middle;
        }

        /* DARK MODE */
        /* ===== DARK MODE ===== */
body.dark {
    background: linear-gradient(135deg, #0f172a, #020617);
    color: #e5e7eb;
}

body.dark .card {
    background: #020617;
    color: #e5e7eb;
}

body.dark table {
    background: #020617;
    color: #e5e7eb;
}

body.dark th {
    background: #020617;
    color: #93c5fd;
}

body.dark td {
    border-color: #1e293b;
}

body.dark .navbar {
    background: #020617 !important;
}

body.dark .alert-success {
    background: #064e3b;
    color: #ecfdf5;
}

body.dark .badge.bg-success {
    background: #16a34a !important;
}

body.dark .badge.bg-danger {
    background: #dc2626 !important;
}

/* Tombol tema */
#themeToggle {
    transition: all 0.3s ease;
}

body.dark #themeToggle {
    background: #facc15;
    color: #020617;
    border-color: #facc15;
}

 </style>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-primary shadow mb-4 rounded-3">
  <div class="container-fluid">
    <span class="navbar-brand fw-bold text-white">
        📘 CMS Guru
    </span>

    <div class="d-flex align-items-center gap-3">
        <span class="text-white">
            Halo, <strong><?= $_SESSION['username']; ?></strong>
        </span>

        <!-- Dark Mode -->
        <button onclick="toggleDarkMode()" 
            id="themeToggle" 
            class="btn btn-outline-light btn-sm">
            🌙
        </button>

        <!-- LOGOUT -->
        <a href="../auth/logout.php" 
           onclick="return confirm('Yakin ingin logout?')"
           class="btn btn-outline-danger btn-sm">
           🚪 Logout
        </a>
    </div>
  </div>
</nav>




<div class="container mt-4">

    <!-- CARD INFO -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm card-stat">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Guru</h6>
                    <h2 class="fw-bold"><?= $totalGuru; ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL -->
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">📋 Data Guru</h5>
                <div class="d-flex gap-2">
    <a href="guru_tambah.php" class="btn btn-success btn-sm">
        ➕ Tambah Guru
    </a>
    <a href="../admin/absensi_guru.php" class="btn btn-warning btn-sm">
        📋 Absensi
    </a>
    <td>
   
    
</td>

</div>

            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Mata Pelajaran</th>
                            <th>Status Hari Ini</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                   <tbody>
<?php $no = 1; ?>
<?php while ($g = mysqli_fetch_assoc($guru)) : ?>

<?php
$id_guru = $g['id'];
$cek = mysqli_query($conn, "
    SELECT * FROM absensi_guru 
    WHERE guru_id='$id_guru' AND tanggal='$tanggal'
");
$absen = mysqli_fetch_assoc($cek);
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $g['nama']; ?></td>
    <td><?= $g['nip']; ?></td>
    <td><?= $g['mata_pelajaran']; ?></td>

    <td>
        <?php if ($absen && $absen['status'] == 'masuk'): ?>
            <span class="badge bg-success px-3 py-2">Masuk</span>
        <?php else: ?>
            <span class="badge bg-danger px-3 py-2">Tidak Masuk</span>
        <?php endif; ?>
    </td>

    <!-- ✅ AKSI SUDAH BENAR -->
    <td>
        <a href="guru_edit.php?id=<?= $g['id']; ?>" 
           class="btn btn-warning btn-sm mb-1">
            ✏️ Edit
        </a>

        <a href="guru_hapus.php?id=<?= $g['id']; ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Yakin hapus guru ini?')">
           🗑️ Hapus
        </a>
    </td>
</tr>

<?php endwhile; ?>
</tbody>


                </table>
            </div>

        </div>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const toggleBtn = document.getElementById("themeToggle");

function setTheme(theme) {
    if (theme === "dark") {
        document.body.classList.add("dark");
        toggleBtn.innerHTML = "☀️";
        localStorage.setItem("theme", "dark");
    } else {
        document.body.classList.remove("dark");
        toggleBtn.innerHTML = "🌙";
        localStorage.setItem("theme", "light");
    }
}

function toggleDarkMode() {
    if (document.body.classList.contains("dark")) {
        setTheme("light");
    } else {
        setTheme("dark");
    }
}

// Saat halaman dibuka
document.addEventListener("DOMContentLoaded", function () {
    const savedTheme = localStorage.getItem("theme") || "light";
    setTheme(savedTheme);
});
</script>

</body>
</html>
