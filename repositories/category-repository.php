<?php

function getCategories()
{
    $categories = [
        [
            "id" => 1,
            "name" => "Fiksi",
            "description" => "Novel dan cerita rekaan",
            "total_books" => 3,
        ],
        [
            "id" => 2,
            "name" => "Sains",
            "description" => "Buku ilmu pengetahuan",
            "total_books" => 2,
        ],
        [
            "id" => 3,
            "name" => "Sejarah",
            "description" => "Buku tentang sejarah",
            "total_books" => 1,
        ],
    ];

    return $categories;
}

function getCategory()
{
    $category = [
        "id" => 1,
        "name" => "Fiksi",
        "description" => "Novel dan cerita rekaan",
        "total_books" => 3,
    ];

    return $category;
}