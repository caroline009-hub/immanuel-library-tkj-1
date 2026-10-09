
<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    echo "Pengguna dengan ID " . $id . " berhasil dihapus.";
} else {
    echo "ID pengguna tidak ditemukan.";
}