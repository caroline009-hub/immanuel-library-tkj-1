```php
<?php
session_start();

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/book-validation.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") { // Memeriksa apakah form update dikirim menggunakan metode POST.

    $id = $_POST['id'] ?? 0; // Mengambil ID buku.

    $request = getBookRequest($_POST);
    $errors = validateBook($request, $id);

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        $_SESSION["old"] = $_POST;

        header("Location: ../../pages/books/edit.php?id=" . urlencode($request["id"]));
        exit;
    }

    try {
        $pdo->beginTransaction(); // Memulai transaksi database.

        // Memperbarui data utama buku.
        $query = "update books set title = :title, isbn = :isbn,
                  year = :year, stock = :stock, category_id = :category_id,
                  description = :description where id = :id";

        $stmt = $pdo->prepare($query); // Menyiapkan query update.
        $stmt->execute([
            'title' => $request["title"], // Mengisi judul buku.
            'isbn' => $request["isbn"], // Mengisi ISBN buku.
            'year' => $request["year"], // Mengisi tahun terbit buku.
            'stock' => $request["stock"], // Mengisi jumlah stok buku.
            'category_id' => $request["category_id"], // Mengisi ID kategori buku.
            'description' => $request["description"], // Mengisi deskripsi buku.
            'id' => $id, // Menentukan buku yang akan diperbarui.
        ]); // Menjalankan query update.

        // Menghapus relasi penulis lama dari buku.
        $query = "delete from book_author where book_id = :id";
        $stmt = $pdo->prepare($query); // Menyiapkan query penghapusan relasi.
        $stmt->execute([
            "id" => $id // Mengisi ID buku yang relasi penulisnya akan dihapus.
        ]);

        // Menambahkan relasi penulis yang baru.
        $query = "insert into book_author (book_id, author_id) values (:book_id, :author_id)";
        $stmt = $pdo->prepare($query); // Menyiapkan query penambahan relasi.

        $authorIds = isset($request['author_ids']) ? $request['author_ids'] : []; // Mengambil daftar ID penulis yang dipilih.

        foreach ($authorIds as $authorId) { // Mengulang setiap ID penulis yang dipilih.

            $stmt->execute([
                'book_id' => $id, // Mengisi ID buku.
                'author_id' => htmlspecialchars($authorId) // Mengisi ID penulis.
            ]); // Menyimpan relasi buku dengan penulis.

        } // Mengakhiri perulangan penulis.

        $pdo->commit(); // Menyimpan semua perubahan transaksi ke database.

        header('Location: ../../pages/books/index.php'); // Mengarahkan pengguna ke halaman daftar buku.

        exit; // Menghentikan proses setelah pengalihan halaman.

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack(); // Membatalkan transaksi jika terjadi error.
        }
        throw $e; // Meneruskan error agar penyebabnya bisa diketahui.
    }
}

?>
