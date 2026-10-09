
<?php
if (
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['role'])
) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    echo "Data pengguna berhasil diterima!";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else {
    echo "Data pengguna tidak lengkap.";
}