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

    // Get all registrants with their related data
    $sql = "SELECT * FROM registrants ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $registrants = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Dashboard</title>
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
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #667eea;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: #4CAF50;
            color: white;
            padding: 8px 16px;
            font-size: 13px;
            margin-right: 5px;
        }

        .btn-edit:hover {
            background: #45a049;
        }

        .btn-delete {
            background: #f44336;
            color: white;
            padding: 8px 16px;
            font-size: 13px;
        }

        .btn-delete:hover {
            background: #da190b;
        }

        .btn-view {
            background: #2196F3;
            color: white;
            padding: 8px 16px;
            font-size: 13px;
            margin-right: 5px;
        }

        .btn-view:hover {
            background: #0b7dda;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #667eea;
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .no-records {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 18px;
        }

        .actions {
            white-space: nowrap;
        }

        .success-message {
            background: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }

        .success-message.show {
            display: block;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
        }

        .table-wrapper {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="successMessage" class="success-message"></div>
        
        <h1>Registration Dashboard</h1>
        
        <div class="header-actions">
            <div class="search-box" style="flex: 1; max-width: 400px;">
                <input type="text" id="searchInput" placeholder="Search by name, email, or mobile number...">
            </div>
            <a href="index.html" class="btn btn-primary">+ New Registration</a>
        </div>

        <div class="table-wrapper">
            <table id="registrantsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Date of Birth</th>
                        <th>Sex</th>
                        <th>Civil Status</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Registered On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($registrants)): ?>
                        <tr>
                            <td colspan="9" class="no-records">No registrations found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($registrants as $registrant): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($registrant['id']); ?></td>
                                <td>
                                    <?php 
                                    echo htmlspecialchars($registrant['first_name'] . ' ' . 
                                         ($registrant['middle_name'] ? $registrant['middle_name'] . ' ' : '') . 
                                         $registrant['last_name']); 
                                    ?>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($registrant['date_of_birth'])); ?></td>
                                <td><?php echo htmlspecialchars($registrant['sex']); ?></td>
                                <td><?php echo htmlspecialchars($registrant['civil_status']); ?></td>
                                <td><?php echo htmlspecialchars($registrant['email']); ?></td>
                                <td><?php echo htmlspecialchars($registrant['mobile_number']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($registrant['created_at'])); ?></td>
                                <td class="actions">
                                    <a href="view.php?id=<?php echo $registrant['id']; ?>" class="btn btn-view">View</a>
                                    <a href="edit.php?id=<?php echo $registrant['id']; ?>" class="btn btn-edit">Edit</a>
                                    <button class="btn btn-delete" onclick="deleteRegistrant(<?php echo $registrant['id']; ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#registrantsTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Delete function
        function deleteRegistrant(id) {
            if (confirm('Are you sure you want to delete this registration? This action cannot be undone.')) {
                fetch('delete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage('Registration deleted successfully');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Error deleting registration');
                    console.error('Error:', error);
                });
            }
        }

        function showMessage(message) {
            const msgEl = document.getElementById('successMessage');
            msgEl.textContent = message;
            msgEl.classList.add('show');
            setTimeout(() => {
                msgEl.classList.remove('show');
            }, 3000);
        }

        // Check for success message from URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === 'updated') {
            showMessage('Registration updated successfully');
        } else if (urlParams.get('success') === 'created') {
            showMessage('Registration created successfully');
        }
    </script>
</body>
</html>