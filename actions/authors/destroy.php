
<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    echo "Penulis dengan ID " . $id . " berhasil dihapus.";
} else {
    echo "ID penulis tidak ditemukan.";
}