
<?php
require_once __DIR__ . "/../config/database.php";

function getBooks()
{
  global $pdo; // Menggunakan koneksi database dari variabel $pdo.

  // Mengambil data buku beserta nama kategorinya.
  $query = "select b.id,
          b.title,
          b.stock,
          c.name as category from books b
          left join categories c on b.category_id = c.id";

  $stmt = $pdo->prepare($query); // Menyiapkan query untuk dijalankan.
  $stmt->execute(); // Menjalankan query.

  $books = $stmt->fetchAll(); // Mengambil semua data buku dalam bentuk array.

  // Mengambil ID buku dan nama penulisnya.
  $query = "select ba.book_id,
          a.name from book_author ba
          left join authors a on ba.author_id = a.id";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $bookAuthors = $stmt->fetchAll();

  $bookByAuthors = [];
  foreach ($bookAuthors as $bookAuthor)
  {
    $bookByAuthors[$bookAuthor['book_id']][] = $bookAuthor['name'];
  }

  foreach ($books as $index => $book)
  {
    $books[$index]['authors'] = $bookByAuthors[$book['id']] ?? [];
  }

  return $books;
}

function getBook($id)
{
  global $pdo;

  // Mengambil data buku berdasarkan ID.
  $query = "select id, title, isbn, year, stock, category_id, description from books where id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    "id" => $id
  ]);

  $book = $stmt->fetch(); // Mengambil data buku.

  if (!$book) {
    header("Location: index.php");
    exit;
  }

  // Mengambil ID penulis yang terhubung dengan buku.
  $query = "select a.id from book_author ba
          left join authors a on ba.author_id = a.id
          where ba.book_id = :book_id";

  $stmt = $pdo->prepare($query);
  $stmt->execute([
    "book_id" => $book["id"]
  ]);

  $authorIds = $stmt->fetchAll();

  // Menyimpan ID penulis ke dalam data buku.
  $book["author_ids"] = array_column($authorIds, "id");

  return $book;
}
