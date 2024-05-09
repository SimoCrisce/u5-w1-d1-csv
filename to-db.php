<?php
$host = 'localhost';
$db   = 'file_system';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);


// $cats = [
//     [
//         "name" => "Meow",
//         "type" => "siamese",
//         "age" => 5
//     ],
//     [
//         "name" => "Fuffy",
//         "type" => "sphynx",
//         "age" => 3
//     ],
//     [
//         "name" => "Arturo",
//         "type" => "floppa",
//         "age" => 4
//     ],
// ];

// $stmt = $pdo->query("INSERT INTO cats ( name, type, age) VALUES ($cats[name], $cats[type], $cats[age]");

$file_handle = fopen ("files/cats.csv", "r");
$data = fgetcsv($file_handle, 1000, ",");
$row = 1;

if (($file_handle = fopen("files/cats.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($file_handle, 1000, ",")) !== FALSE) {
        $stmt = $pdo->query("INSERT INTO cats ( name, type, age) VALUES ('$data[0]', '$data[1]', $data[2])");
    }
    fclose($file_handle);
}

