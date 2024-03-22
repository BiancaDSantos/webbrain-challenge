<?php
include "Database.php";

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$page = $_GET['page'] ?? 1;
$perPage = $_GET['per_page'] ?? 6;
$options = $_GET['options'] ?? null;

$offset = ($page - 1) * $perPage;

$conn = Database::getConn();

if (empty($options)) {

    $stmt = $conn->prepare("
        select 
            ct.*,
            group_concat(cco.contact_options_id separator ',') 'options'
        from contacts ct
        join contact_contact_options cco
            on cco.contact_id = ct.id
        group by 
            ct.id,
            ct.name,
            ct.birth_date,
            ct.email,
            ct.whatsapp,
            ct.phone,
            ct.message
        limit :limit
        offset :offset
    ");

    $stmt->bindParam(":limit", $perPage, PDO::PARAM_INT);
    $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
    $stmt->execute();
    $contacts = $stmt->fetchAll();


    $result = array_map(
        function(mixed $contact): mixed {
            $contact["options"] = array_map("intval", explode(",", $contact["options"]));
            return $contact;
        },
        $contacts
    );

    $pagination["data"] = $result;
    $pagination["current_page"] = intval($page);
    $pagination["quantity"] = count($result);
    $pagination["per_page"] = intval($perPage);

    $stmtQuantity = $conn->query("select count(1) as quantity from contacts");

    $pagination["total"] = $stmtQuantity->fetch()["quantity"];
    $pagination["last_page"] = ceil($pagination["total"]/$perPage);
    
    echo json_encode($pagination);
    exit();
}

echo json_encode("preenchido");
exit();

