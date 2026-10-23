<?php
$host = "localhost"; // Alamat server database
$dbname = "immanuel_library"; // Nama database yang digunakan
$username = "root"; // Username untuk login database
$password = ""; // Password database, kosong

// Menentukan informasi koneksi database MySQL
$dsn = "mysql:host=$host;
        dbname=$dbname;
        charset=utf8mb4";

$options =
        [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //kasih tau errornya kenapa
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //data yang dikembalikan database akan diambil
                //kembali dalam bentuk array asosiatif
                PDO::ATTR_EMULATE_PREPARES => false //kalau kita input angka tetep masuk sebagai angka
                //begiru juga dengan string
        ];

try //untuk menjalankan kode yang mungkin mengalami error
{
        $pdo = new PDO($dsn, $username, $password, $options); // Membuat koneksi ke database menggunakan PDO.
        // PDO digunakan untuk menghubungkan PHP dengan database.
} catch (PDOException $error) // Menangkap error jika koneksi database gagal.
{
        // Menghentikan program dan menampilkan pesan jika koneksi gagal.
        die("Koneksi ke database gagal:"
                . $error->getMessage());
}
?>