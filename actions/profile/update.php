
<?php
if (isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['bio'])) {
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $bio = $_POST['bio'];

    echo "Data profil berhasil diterima!";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else {
    echo "Data profil tidak lengkap.";
}