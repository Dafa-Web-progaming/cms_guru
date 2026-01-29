<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$tanggal = date('Y-m-d');

// Ambil semua guru
$guru = mysqli_query($conn, "SELECT * FROM guru");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Absensi Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: Arial; background: #f4f6f8; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #34495e; color: white; }
        button { padding: 5px 10px; }
        .masuk { background: green; color: white; }
        .tidak { background: red; color: white; }
    </style>
</head>

<body>

<h2>Absensi Guru</h2>
<p>Tanggal: <b><?= $tanggal; ?></b></p>

<table>
    <tr>
        <th>No</th>
        <th>Nama Guru</th>
        <th>Mata Pelajaran</th>
        <th>Status</th>
    </tr>

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
        <td><?= $g['mata_pelajaran']; ?></td>
        <td>

            <?php if ($absen): ?>
                <b><?= strtoupper($absen['status']); ?></b>
            <?php else: ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="guru_id" value="<?= $id_guru; ?>">
                    <input type="hidden" name="status" value="masuk">
                    <button class="masuk" name="absen">Masuk</button>
                </form>

                <form method="POST" style="display:inline;">
                    <input type="hidden" name="guru_id" value="<?= $id_guru; ?>">
                    <input type="hidden" name="status" value="tidak">
                    <button class="tidak" name="absen">Tidak</button>
                </form>
            <?php endif; ?>

        </td>
    </tr>

    <?php endwhile; ?>
</table>

<br>
<a href="dashboard.php">⬅ Kembali ke Dashboard</a>

<?php
// PROSES ABSENSI
if (isset($_POST['absen'])) {
    $guru_id = $_POST['guru_id'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        INSERT INTO absensi_guru (guru_id, tanggal, status)
        VALUES ('$guru_id', '$tanggal', '$status')
    ");

    echo "<script>window.location='absensi.php';</script>";
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
