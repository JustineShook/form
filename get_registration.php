<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'sss_registration';
$username = 'root';
$password = '';

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    if (!isset($_GET['id'])) {
        throw new Exception("No ID provided");
    }

    $id = (int)$_GET['id'];

    // Get registrant data
    $sql = "SELECT * FROM registrants WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $registrant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$registrant) {
        throw new Exception("Registrant not found");
    }

    // Get spouse data
    $spouseSql = "SELECT * FROM spouses WHERE registrant_id = :id";
    $spouseStmt = $conn->prepare($spouseSql);
    $spouseStmt->execute([':id' => $id]);
    $spouse = $spouseStmt->fetch(PDO::FETCH_ASSOC);

    // Get children data
    $childrenSql = "SELECT * FROM children WHERE registrant_id = :id ORDER BY order_index";
    $childrenStmt = $conn->prepare($childrenSql);
    $childrenStmt->execute([':id' => $id]);
    $children = $childrenStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get beneficiaries data
    $beneficiariesSql = "SELECT * FROM beneficiaries WHERE registrant_id = :id ORDER BY order_index";
    $beneficiariesStmt = $conn->prepare($beneficiariesSql);
    $beneficiariesStmt->execute([':id' => $id]);
    $beneficiaries = $beneficiariesStmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => [
            'registrant' => $registrant,
            'spouse' => $spouse,
            'children' => $children,
            'beneficiaries' => $beneficiaries
        ]
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>