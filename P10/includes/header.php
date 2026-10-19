<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sudahLogin = isset($_SESSION['user_id']);

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <?php
                $halaman = basename($_SERVER['SCRIPT_NAME']);
                $folder = basename(dirname($_SERVER['SCRIPT_NAME']));

                $aktifBeranda = ($halaman === 'index.php' && $folder === 'P10');
                $aktifDaftarBuku = ($folder === 'buku' && in_array($halaman, ['list.php', 'edit.php', 'proses_edit.php']));
                $aktifTambahBuku = ($folder === 'buku' && in_array($halaman, ['tambah.php', 'proses_tambah.php']));
                $aktifDaftarAnggota = ($folder === 'anggota' && in_array($halaman, ['list.php', 'edit.php', 'proses_edit.php']));
                $aktifTambahAnggota = ($folder === 'anggota' && in_array($halaman, ['tambah.php', 'proses_tambah.php']));
                ?>

                <li><a href="<?php echo $base; ?>index.php" class="<?php echo $aktifBeranda ? 'active' : ''; ?>">Beranda</a></li>
                <li><a href="<?php echo $base; ?>buku/list.php" class="<?php echo $aktifDaftarBuku ? 'active' : ''; ?>">Daftar Buku</a></li>
                <?php if ($sudahLogin): ?>
                <li><a href="<?php echo $base; ?>buku/tambah.php" class="<?php echo $aktifTambahBuku ? 'active' : ''; ?>">Tambah Buku</a></li>
                <li><a href="<?php echo $base; ?>anggota/list.php"  class="<?php echo $aktifDaftarAnggota ? 'active' : ''; ?>">Daftar Anggota</a></li>
                <li><a href="<?php echo $base; ?>anggota/tambah.php" class="<?php echo $aktifTambahAnggota ? 'active' : ''; ?>">Tambah Anggota</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-status">
            <?php if ($sudahLogin): ?>
                <div class="profil-petugas">
                    <button type="button" id="tombolProfil" class="tombol-profil" aria-expanded="false" aria-controls="menuProfil">
                        <img src="<?php echo $base; ?>assets/img/profil.png" alt="Foto petugas">
                        <span><?php echo $_SESSION['nama']; ?></span>
                        <span class="panah">&#9662;</span>
                    </button>
                <div id="menuProfil" class="menu-profil">
                    <a href="<?php echo $base; ?>auth/logout.php">Logout</a>
                </div>
                </div>
            <?php else: ?>
                <a href="<?php echo $base; ?>auth/login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <main>
        