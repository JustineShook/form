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

    if (!isset($_POST['id'])) {
        throw new Exception("No ID provided");
    }

    $registrant_id = (int)$_POST['id'];

    // Start transaction
    $conn->beginTransaction();

    // ==================== UPDATE MAIN REGISTRANT DATA ====================
    $last_name       = trim($_POST['last_name'] ?? '');
    $first_name      = trim($_POST['first_name'] ?? '');
    $middle_name     = trim($_POST['middle_name'] ?? null);
    $dob             = $_POST['dob'] ?? '';
    $sex             = $_POST['sex'] ?? '';
    $civil_status    = $_POST['civil_status'] ?? '';
    $nationality     = trim($_POST['nationality'] ?? '');
    $place_of_birth  = trim($_POST['place_of_birth'] ?? '');
    $same_address    = isset($_POST['same_address']) ? 1 : 0;
    $home_address    = trim($_POST['home_address'] ?? '');
    $mobile_number   = trim($_POST['mobile_number'] ?? '');
    $email           = trim($_POST['email'] ?? '');

    $mother_last_name   = trim($_POST['mother_last_name'] ?? '');
    $mother_first_name  = trim($_POST['mother_first_name'] ?? '');
    $mother_middle_name = trim($_POST['mother_middle_name'] ?? '');
    $father_last_name   = trim($_POST['father_last_name'] ?? '');
    $father_first_name  = trim($_POST['father_first_name'] ?? '');
    $father_middle_name = trim($_POST['father_middle_name'] ?? '');

    // Validate required fields
    if (
        !$last_name || !$first_name || !$dob || !$sex ||
        !$civil_status || !$nationality || !$place_of_birth ||
        !$home_address || !$mobile_number || !$email ||
        !$mother_last_name || !$mother_first_name || !$mother_middle_name ||
        !$father_last_name || !$father_first_name || !$father_middle_name
    ) {
        throw new Exception("Missing required fields");
    }

    // Validate ENUM values
    if (!in_array($sex, ['Male', 'Female'])) {
        throw new Exception("Invalid sex value");
    }

    $validCivilStatus = ['Single', 'Married', 'Widowed', 'Legally Separated', 'Others'];
    if (!in_array($civil_status, $validCivilStatus)) {
        throw new Exception("Invalid civil status");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
    }

    // Validate mobile number (11 digits starting with 09)
    if (!preg_match('/^09\d{9}$/', $mobile_number)) {
        throw new Exception("Invalid mobile number format");
    }

    // Update main registrant
    $sql = "UPDATE registrants SET
        last_name = :last_name,
        first_name = :first_name,
        middle_name = :middle_name,
        date_of_birth = :dob,
        sex = :sex,
        civil_status = :civil_status,
        nationality = :nationality,
        place_of_birth = :place_of_birth,
        same_address = :same_address,
        home_address = :home_address,
        mobile_number = :mobile_number,
        email = :email,
        mother_last_name = :mother_last_name,
        mother_first_name = :mother_first_name,
        mother_middle_name = :mother_middle_name,
        father_last_name = :father_last_name,
        father_first_name = :father_first_name,
        father_middle_name = :father_middle_name
    WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id' => $registrant_id,
        ':last_name' => $last_name,
        ':first_name' => $first_name,
        ':middle_name' => $middle_name,
        ':dob' => $dob,
        ':sex' => $sex,
        ':civil_status' => $civil_status,
        ':nationality' => $nationality,
        ':place_of_birth' => $place_of_birth,
        ':same_address' => $same_address,
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

    // ==================== UPDATE SPOUSE DATA ====================
    // Delete existing spouse
    $conn->prepare("DELETE FROM spouses WHERE registrant_id = :id")->execute([':id' => $registrant_id]);

    $spouse_last_name = trim($_POST['spouse_last_name'] ?? '');
    $spouse_first_name = trim($_POST['spouse_first_name'] ?? '');
    $spouse_middle_name = trim($_POST['spouse_middle_name'] ?? '');
    $spouse_suffix = trim($_POST['spouse_suffix'] ?? '');
    $spouse_dob = $_POST['spouse_dob'] ?? null;

    // Only insert if at least one spouse field is filled
    if ($spouse_last_name || $spouse_first_name) {
        $sql = "INSERT INTO spouses (
            registrant_id, last_name, first_name, middle_name, suffix, date_of_birth
        ) VALUES (
            :registrant_id, :last_name, :first_name, :middle_name, :suffix, :dob
        )";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':registrant_id' => $registrant_id,
            ':last_name' => $spouse_last_name ?: null,
            ':first_name' => $spouse_first_name ?: null,
            ':middle_name' => $spouse_middle_name ?: null,
            ':suffix' => $spouse_suffix ?: null,
            ':dob' => $spouse_dob ?: null
        ]);
    }

    // ==================== UPDATE CHILDREN DATA ====================
    // Delete existing children
    $conn->prepare("DELETE FROM children WHERE registrant_id = :id")->execute([':id' => $registrant_id]);

    $childrenCount = 0;
    foreach ($_POST as $key => $value) {
        if (preg_match('/^child_last_name_(\d+)$/', $key, $matches)) {
            $index = $matches[1];
            
            $child_last_name = trim($_POST["child_last_name_$index"] ?? '');
            $child_first_name = trim($_POST["child_first_name_$index"] ?? '');
            $child_middle_name = trim($_POST["child_middle_name_$index"] ?? '');
            $child_suffix = trim($_POST["child_suffix_$index"] ?? '');
            $child_dob = $_POST["child_dob_$index"] ?? null;

            // Only insert if at least last name or first name is filled
            if ($child_last_name || $child_first_name) {
                $sql = "INSERT INTO children (
                    registrant_id, last_name, first_name, middle_name, suffix, date_of_birth, order_index
                ) VALUES (
                    :registrant_id, :last_name, :first_name, :middle_name, :suffix, :dob, :order_index
                )";

                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':registrant_id' => $registrant_id,
                    ':last_name' => $child_last_name ?: null,
                    ':first_name' => $child_first_name ?: null,
                    ':middle_name' => $child_middle_name ?: null,
                    ':suffix' => $child_suffix ?: null,
                    ':dob' => $child_dob ?: null,
                    ':order_index' => $index
                ]);
                $childrenCount++;
            }
        }
    }

    // ==================== UPDATE BENEFICIARIES DATA ====================
    // Delete existing beneficiaries
    $conn->prepare("DELETE FROM beneficiaries WHERE registrant_id = :id")->execute([':id' => $registrant_id]);

    $beneficiariesCount = 0;
    foreach ($_POST as $key => $value) {
        if (preg_match('/^beneficiary_last_name_(\d+)$/', $key, $matches)) {
            $index = $matches[1];
            
            $beneficiary_last_name = trim($_POST["beneficiary_last_name_$index"] ?? '');
            $beneficiary_first_name = trim($_POST["beneficiary_first_name_$index"] ?? '');
            $beneficiary_middle_name = trim($_POST["beneficiary_middle_name_$index"] ?? '');
            $beneficiary_suffix = trim($_POST["beneficiary_suffix_$index"] ?? '');
            $beneficiary_relationship = trim($_POST["beneficiary_relationship_$index"] ?? '');
            $beneficiary_dob = $_POST["beneficiary_dob_$index"] ?? null;

            // Only insert if at least last name or first name is filled
            if ($beneficiary_last_name || $beneficiary_first_name) {
                $sql = "INSERT INTO beneficiaries (
                    registrant_id, last_name, first_name, middle_name, suffix, relationship, date_of_birth, order_index
                ) VALUES (
                    :registrant_id, :last_name, :first_name, :middle_name, :suffix, :relationship, :dob, :order_index
                )";

                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':registrant_id' => $registrant_id,
                    ':last_name' => $beneficiary_last_name ?: null,
                    ':first_name' => $beneficiary_first_name ?: null,
                    ':middle_name' => $beneficiary_middle_name ?: null,
                    ':suffix' => $beneficiary_suffix ?: null,
                    ':relationship' => $beneficiary_relationship ?: null,
                    ':dob' => $beneficiary_dob ?: null,
                    ':order_index' => $index
                ]);
                $beneficiariesCount++;
            }
        }
    }

    // Commit transaction
    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Registration updated successfully',
        'data' => [
            'registrant_id' => $registrant_id,
            'children_updated' => $childrenCount,
            'beneficiaries_updated' => $beneficiariesCount
        ]
    ]);

} catch (Exception $e) {
    // Rollback transaction on error
    if (isset($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>