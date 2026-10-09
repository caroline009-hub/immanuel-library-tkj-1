<?php

if (
    isset($_POST['title']) &&
    isset($_POST['isbn']) &&
    isset($_POST['year']) &&
    isset($_POST['stock']) &&
    isset($_POST['category_id']) &&
    isset($_POST['description'])
) {
    $title = $_POST['title'];
    $isbn = $_POST['isbn'];
    $year = $_POST['year'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $author_ids = $_POST['author_ids'] ?? [];

    echo "Data buku berhasil diterima!";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else {
    echo "Data buku tidak lengkap.";
}