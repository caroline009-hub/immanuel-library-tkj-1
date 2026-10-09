
<?php

if (
    isset($_POST['id']) &&
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['role'])
) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    echo "Data pengguna berhasil diterima!";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else {
    echo "Data pengguna tidak lengkap.";
}