<?php
include "Database.php";

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

$name = $data['name'] ?? null;
$birth_date_str = $data['birth_date'] ?? null;
$birth_date = strtotime($birth_date_str);
$email = $data['email'] ?? null;
$whatsApp = $data['whatsApp'] ?? null;
$phone = $data['phone'] ?? null;
$message = $data['message'] ?? null;
$options = $data['options'] ?? null;

$conn = Database::getConn();

if ($name !== null 
    && $birth_date !== false && $birth_date != -1
    && $email !== null
    && $whatsApp !== null
    && $phone !== null
    && $message !== null
    && !empty($options)
) {

    $stmt = $conn->prepare("
        insert into contacts (name, birth_date, email, whatsApp, phone, message)
        values (:name, :birth_date, :email, :whatsApp, :phone, :message);
    ");
    
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":birth_date", $birth_date_str);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":whatsApp", $whatsApp);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":message", $message);

    $stmt->execute();

    $contactId = $conn->lastInsertId();

    if ($contactId !== null) {
        $stmtResult = $conn->prepare("
            select 
                id,
                name,
                birth_date,
                email,
                whatsApp,
                phone,
                message
            from contacts
            where id = :id;
        ");

        $stmtResult->bindParam(":id", $contactId);
        $stmtResult->execute();
        $result = $stmtResult->fetch();

        if ($result !== null) {
            
            $stmtOptions = $conn->prepare("
                insert into contact_contact_options (contact_id, contact_options_id)
                values (:contact_id, :contact_options_id);
            ");

            $stmtOptions->bindParam(":contact_id", $contactId);

            foreach ($options as $option) {
                $stmtOptions->bindParam(":contact_options_id", $option["contact_options_id"]);
                $stmtOptions->execute();
            }
            
            $stmtContactOptions = $conn->prepare("
                select distinct * 
                from webbrain.contact_options co
                where exists(
                    select 1
                    from webbrain.contact_contact_options cco
                    where cco.contact_options_id = co.id
                    and   cco.contact_id = :contact_id
                )
            ");

            $stmtContactOptions->bindParam(":contact_id", $contactId);
            $stmtContactOptions->execute();

            $contactOptions = $stmtContactOptions->fetchAll();

            $result["options"] = $contactOptions;

            echo json_encode($result);
            exit();
        }
    }
}
echo json_encode($data);
exit();
?>