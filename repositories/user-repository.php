
<?php

function getUsers()
{
    $users = [
        [
            "id" => 1,
            "name" => "Budi Santoso",
            "email" => "budi@gmail.com",
            "role" => "Admin"
        ],
        [
            "id" => 2,
            "name" => "Siti Aminah",
            "email" => "siti@gmail.com",
            "role" => "Member"
        ],
        [
            "id" => 3,
            "name" => "Andi Wijaya",
            "email" => "andi@gmail.com",
            "role" => "Member"
        ]
    ];

    return $users;
}

function getUser()
{
    $user = [
        "id" => 1,
        "name" => "Budi Santoso",
        "email" => "budi@gmail.com",
        "role" => "Admin"
    ];

    return $user;
}


function getProfile()
{
    $profile = [
        "phone" => "081234567890",
        "address" => "Pontianak",
        "bio" => "Pengguna perpustakaan"
    ];

    return $profile;
}