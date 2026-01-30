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

    if (!isset($_POST['id']) || empty($_POST['id'])) {
        throw new Exception("No ID provided");
    }

    $id = (int)$_POST['id'];

    // Check if registrant exists
    $checkSql = "SELECT id FROM registrants WHERE id = :id";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->execute([':id' => $id]);
    
    if (!$checkStmt->fetch()) {
        throw new Exception("Registrant not found");
    }

    // Delete registrant (CASCADE will automatically delete related records)
    $sql = "DELETE FROM registrants WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo json_encode([
        'success' => true,
        'message' => 'Registration deleted successfully'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>