<?php
include "Database.php";

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");


$conn = Database::getConn();

$stmt = $conn->query("
    select * from contact_options
");

$contactOptions = $stmt->fetchAll();

echo json_encode($contactOptions);