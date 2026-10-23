<?php
require_once __DIR__ . "/../../config/database.php"; // Memanggil file koneksi database.

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === "GET") { // Memeriksa apakah ID tersedia dan request menggunakan GET.
    try {
        $pdo->beginTransaction(); // Memulai transaksi database.

        $id = $_GET['id']; // Mengambil ID buku dari URL.

        // Delete relation data (Book Author)
        $query = "delete from book_author where book_id = :id"; // Membuat query untuk menghapus relasi buku dan penulis.
        $stmt = $pdo->prepare($query); // Menyiapkan query.
        $stmt->execute([
            "id" => $id // Mengisi ID buku yang relasinya akan dihapus.
        ]);

        // Delete Book data
        $query = "delete from books where id = :id"; // Membuat query untuk menghapus data buku.
        $stmt = $pdo->prepare($query); // Menyiapkan query.
        $stmt->execute([
            "id" => $id // Mengisi ID buku yang akan dihapus.
        ]);

        $pdo->commit(); // Menyimpan perubahan transaksi ke database.

        header("Location: ../../pages/books/index.php"); // Mengarahkan kembali ke halaman daftar buku.
        exit; // Menghentikan proses setelah pengalihan halaman.

    } catch (PDOException $e) {
        $pdo->rollBack(); // Membatalkan transaksi jika terjadi error.
        throw $e; // Meneruskan error agar penyebabnya dapat diketahui.
    }
}
?>