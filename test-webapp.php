<?php
/**
 * Test Web Application Script
 * Course: Information Management
 * Purpose: Portfolio activity for database connectivity and data verification testing
 */

// 1. Database Configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'test_db';

// 2. Establish Database Connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check Connection Status
$connection_status = "";
if ($conn->connect_error) {
    $connection_status = "<p style='color: red;'><strong>Connection Failed:</strong> " . $conn->connect_error . "</p>";
} else {
    $connection_status = "<p style='color: green;'><strong>Database Connected Successfully!</strong></p>";
}

// 3. Form Submission Handling & Data Verification Test
$submitted_data = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data to prevent SQL Injection / XSS
    $username = htmlspecialchars(trim($_POST['username']));
    $email    = htmlspecialchars(trim($_POST['email']));

    if (!empty($username) && !empty($email)) {
        $submitted_data = "
            <div style='background-color: #eef; padding: 10px; border-radius: 5px; margin-top: 15px;'>
                <h4>Data Received & Verified:</h4>
                <p><strong>Username:</strong> {$username}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Status:</strong> Ready for DB verification/QA test entry.</p>
            </div>";
    } else {
        $submitted_data = "<p style='color: red;'>Please fill in all required fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio QA Test Web Application</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { max-width: 500px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<div class="container">
    <h2>Web App Testing Script</h2>
    
    <!-- Connection Status Banner -->
    <?php echo $connection_status; ?>

    <!-- Data Input Form for QA Testing -->
    <form method="POST" action="test-webapp.php">
        <div class="form-group">
            <label for="username">Username / Tester Name:</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <button type="submit">Submit Test Data</button>
    </form>

    <!-- Output Display -->
    <?php echo $submitted_data; ?>
</div>

</body>
</html>
<?php
// Close Database Connection
if (isset($conn) && !$conn->connect_error) {
    $conn->close();
}
?>
