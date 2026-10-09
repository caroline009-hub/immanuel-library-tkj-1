
<?php

if (isset($_POST['name']) && isset($_POST['bio'])) {
    $name = $_POST['name'];
    $bio = $_POST['bio'];

    echo "Data penulis berhasil diterima!";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else {
    echo "Data penulis tidak lengkap.";
}