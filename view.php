<?php
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
        header('Location: dashboard.php');
        exit;
    }

    $id = (int)$_GET['id'];

    // Get registrant data
    $sql = "SELECT * FROM registrants WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $registrant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$registrant) {
        header('Location: dashboard.php');
        exit;
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

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registration - <?php echo htmlspecialchars($registrant['first_name'] . ' ' . $registrant['last_name']); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }

        h1 {
            color: #333;
            font-size: 28px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            margin-left: 10px;
        }

        .btn-back {
            background: #6c757d;
            color: white;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        .btn-edit {
            background: #4CAF50;
            color: white;
        }

        .btn-edit:hover {
            background: #45a049;
        }

        .section {
            margin-bottom: 40px;
        }

        .section-title {
            background: #667eea;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 15px;
        }

        .info-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #667eea;
        }

        .info-label {
            font-weight: 600;
            color: #666;
            font-size: 13px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .info-value {
            color: #333;
            font-size: 16px;
        }

        .dependent-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 15px;
            border-left: 4px solid #4CAF50;
        }

        .dependent-number {
            font-weight: 600;
            color: #667eea;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }

        .actions {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registration Details</h1>
            <div class="actions">
                <a href="dashboard.php" class="btn btn-back">← Back to Dashboard</a>
                <a href="edit.php?id=<?php echo $registrant['id']; ?>" class="btn btn-edit">Edit</a>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="section">
            <div class="section-title">Personal Information</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($registrant['first_name'] . ' ' . 
                             ($registrant['middle_name'] ? $registrant['middle_name'] . ' ' : '') . 
                             $registrant['last_name']); ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Date of Birth</div>
                    <div class="info-value"><?php echo date('F d, Y', strtotime($registrant['date_of_birth'])); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Sex</div>
                    <div class="info-value"><?php echo htmlspecialchars($registrant['sex']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Civil Status</div>
                    <div class="info-value"><?php echo htmlspecialchars($registrant['civil_status']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Nationality</div>
                    <div class="info-value"><?php echo htmlspecialchars($registrant['nationality']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Place of Birth</div>
                    <div class="info-value"><?php echo htmlspecialchars($registrant['place_of_birth']); ?></div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="section">
            <div class="section-title">Contact Information</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Home Address</div>
                    <div class="info-value"><?php echo htmlspecialchars($registrant['home_address']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Mobile Number</div>
                    <div class="info-value"><?php echo htmlspecialchars($registrant['mobile_number']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email Address</div>
                    <div class="info-value"><?php echo htmlspecialchars($registrant['email']); ?></div>
                </div>
            </div>
        </div>

        <!-- Parents Information -->
        <div class="section">
            <div class="section-title">Parents Information</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Mother's Name</div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($registrant['mother_first_name'] . ' ' . 
                             $registrant['mother_middle_name'] . ' ' . 
                             $registrant['mother_last_name']); ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Father's Name</div>
                    <div class="info-value">
                        <?php echo htmlspecialchars($registrant['father_first_name'] . ' ' . 
                             $registrant['father_middle_name'] . ' ' . 
                             $registrant['father_last_name']); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spouse Information -->
        <div class="section">
            <div class="section-title">Spouse Information</div>
            <?php if ($spouse): ?>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">
                            <?php echo htmlspecialchars(
                                ($spouse['first_name'] ?: '') . ' ' . 
                                ($spouse['middle_name'] ?: '') . ' ' . 
                                ($spouse['last_name'] ?: '') . ' ' .
                                ($spouse['suffix'] ?: '')
                            ); ?>
                        </div>
                    </div>
                    <?php if ($spouse['date_of_birth']): ?>
                        <div class="info-item">
                            <div class="info-label">Date of Birth</div>
                            <div class="info-value"><?php echo date('F d, Y', strtotime($spouse['date_of_birth'])); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="no-data">No spouse information provided</div>
            <?php endif; ?>
        </div>

        <!-- Children Information -->
        <div class="section">
            <div class="section-title">Children</div>
            <?php if (!empty($children)): ?>
                <?php foreach ($children as $index => $child): ?>
                    <div class="dependent-card">
                        <div class="dependent-number">Child #<?php echo ($index + 1); ?></div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Full Name</div>
                                <div class="info-value">
                                    <?php echo htmlspecialchars(
                                        ($child['first_name'] ?: '') . ' ' . 
                                        ($child['middle_name'] ?: '') . ' ' . 
                                        ($child['last_name'] ?: '') . ' ' .
                                        ($child['suffix'] ?: '')
                                    ); ?>
                                </div>
                            </div>
                            <?php if ($child['date_of_birth']): ?>
                                <div class="info-item">
                                    <div class="info-label">Date of Birth</div>
                                    <div class="info-value"><?php echo date('F d, Y', strtotime($child['date_of_birth'])); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-data">No children information provided</div>
            <?php endif; ?>
        </div>

        <!-- Beneficiaries Information -->
        <div class="section">
            <div class="section-title">Other Beneficiaries</div>
            <?php if (!empty($beneficiaries)): ?>
                <?php foreach ($beneficiaries as $index => $beneficiary): ?>
                    <div class="dependent-card">
                        <div class="dependent-number">Beneficiary #<?php echo ($index + 1); ?></div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Full Name</div>
                                <div class="info-value">
                                    <?php echo htmlspecialchars(
                                        ($beneficiary['first_name'] ?: '') . ' ' . 
                                        ($beneficiary['middle_name'] ?: '') . ' ' . 
                                        ($beneficiary['last_name'] ?: '') . ' ' .
                                        ($beneficiary['suffix'] ?: '')
                                    ); ?>
                                </div>
                            </div>
                            <?php if ($beneficiary['relationship']): ?>
                                <div class="info-item">
                                    <div class="info-label">Relationship</div>
                                    <div class="info-value"><?php echo htmlspecialchars($beneficiary['relationship']); ?></div>
                                </div>
                            <?php endif; ?>
                            <?php if ($beneficiary['date_of_birth']): ?>
                                <div class="info-item">
                                    <div class="info-label">Date of Birth</div>
                                    <div class="info-value"><?php echo date('F d, Y', strtotime($beneficiary['date_of_birth'])); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-data">No beneficiaries information provided</div>
            <?php endif; ?>
        </div>

        <!-- Registration Details -->
        <div class="section">
            <div class="section-title">Registration Details</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Registration ID</div>
                    <div class="info-value"><?php echo $registrant['id']; ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Registered On</div>
                    <div class="info-value"><?php echo date('F d, Y h:i A', strtotime($registrant['created_at'])); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Last Updated</div>
                    <div class="info-value"><?php echo date('F d, Y h:i A', strtotime($registrant['updated_at'])); ?></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>