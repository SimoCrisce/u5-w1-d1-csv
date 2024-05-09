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

$stmt = $pdo->query("SELECT * FROM dogs");
$dogs = $stmt->fetchAll();

// $dogs = [
//     [
//         "name" => "Margot",
//         "type" => "cocker",
//         "age" => 5
//     ],
//     [
//         "name" => "Kelly",
//         "type" => "barboncino",
//         "age" => 3
//     ],
//     [
//         "name" => "Cupcake",
//         "type" => "pitbull",
//         "age" => 4
//     ],
// ];

$file_handle = fopen ("files/dogs.csv", "w");

fputcsv($file_handle, array_keys($dogs[0]));
foreach($dogs as $index => $row) {
    fputcsv($file_handle, $row);
}

fclose($file_handle);
