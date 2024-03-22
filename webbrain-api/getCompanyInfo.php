<?php
include "Database.php";

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
$companyId = $_GET["id"];

$conn = Database::getConn();

if ($companyId !== null) {
    $stmt = $conn->prepare("select * from company_infos where id = :id");
    $stmt->bindParam(":id", $companyId, PDO::PARAM_INT);
    $stmt->execute();
    $company = $stmt->fetch();
    if($company !== false) {
        echo json_encode($company);
        exit();
    }

    echo json_encode($companyId);
    exit();
}

echo json_encode(1);
exit();