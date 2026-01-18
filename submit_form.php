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

    // Required fields
    $last_name       = trim($_POST['last_name'] ?? '');
    $first_name      = trim($_POST['first_name'] ?? '');
    $middle_name     = trim($_POST['middle_name'] ?? null);
    $dob             = $_POST['dob'] ?? '';
    $sex             = $_POST['sex'] ?? '';
    $civil_status    = $_POST['civil_status'] ?? '';
    $nationality     = trim($_POST['nationality'] ?? '');
    $place_of_birth  = trim($_POST['place_of_birth'] ?? '');
    $home_address    = trim($_POST['home_address'] ?? '');
    $mobile_number   = trim($_POST['mobile_number'] ?? '');
    $email           = trim($_POST['email'] ?? '');

    $mother_last_name   = trim($_POST['mother_last_name'] ?? null);
    $mother_first_name  = trim($_POST['mother_first_name'] ?? null);
    $mother_middle_name = trim($_POST['mother_middle_name'] ?? null);
    $father_last_name   = trim($_POST['father_last_name'] ?? null);
    $father_first_name  = trim($_POST['father_first_name'] ?? null);
    $father_middle_name = trim($_POST['father_middle_name'] ?? null);

    // Validate required
    if (
        !$last_name || !$first_name || !$dob || !$sex ||
        !$civil_status || !$nationality || !$place_of_birth ||
        !$home_address || !$mobile_number || !$email
    ) {
        throw new Exception("Missing required fields");
    }

    // ENUM protection
    if (!in_array($sex, ['Male', 'Female'])) {
        throw new Exception("Invalid sex value");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email");
    }

    $sql = "INSERT INTO registrations (
        last_name, first_name, middle_name, dob, sex, civil_status, nationality,
        place_of_birth, home_address, mobile_number, email,
        mother_last_name, mother_first_name, mother_middle_name,
        father_last_name, father_first_name, father_middle_name
    ) VALUES (
        :last_name, :first_name, :middle_name, :dob, :sex, :civil_status, :nationality,
        :place_of_birth, :home_address, :mobile_number, :email,
        :mother_last_name, :mother_first_name, :mother_middle_name,
        :father_last_name, :father_first_name, :father_middle_name
    )";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':last_name' => $last_name,
        ':first_name' => $first_name,
        ':middle_name' => $middle_name,
        ':dob' => $dob,
        ':sex' => $sex,
        ':civil_status' => $civil_status,
        ':nationality' => $nationality,
        ':place_of_birth' => $place_of_birth,
        ':home_address' => $home_address,
        ':mobile_number' => $mobile_number,
        ':email' => $email,
        ':mother_last_name' => $mother_last_name,
        ':mother_first_name' => $mother_first_name,
        ':mother_middle_name' => $mother_middle_name,
        ':father_last_name' => $father_last_name,
        ':father_first_name' => $father_first_name,
        ':father_middle_name' => $father_middle_name
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Registration submitted successfully'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
