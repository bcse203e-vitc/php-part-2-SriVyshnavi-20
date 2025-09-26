<?php
date_default_timezone_set('Asia/Kolkata');

$input_file = 'students.txt';
$error_log_file = 'errors.log';
$valid_records = [];
$error_logs = [];
$email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

if (!file_exists($input_file)) {
    echo "<p style='color: red;'>Error: Input file **$input_file** not found.</p>";
    exit;
}

$lines = file($input_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line_number => $line) {
    $line_number++; // Start counting from 1
    $fields = explode(',', $line);
    if (count($fields) < 3) {
        $error_logs[] = "Line $line_number: Incomplete fields - $line";
        continue;
    }

    $name = trim($fields[0]);
    $email = trim($fields[1]);
    $dob_str = trim($fields[2]);
    if (!preg_match($email_regex, $email)) {
        $error_logs[] = "Line $line_number: Invalid Email ($email) - $line";
        continue;
    }
    try {
        $dob = new DateTime($dob_str);
        $now = new DateTime();
        $age_interval = $now->diff($dob);
        $age = $age_interval->y;
        
        if ($age < 0 || $age > 120) { // Simple age range check
            throw new Exception("Age is unrealistic.");
        }
        
    } catch (Exception $e) {
       
        $error_logs[] = "Line $line_number: Invalid DateOfBirth ($dob_str) - $line";
        continue;
    }

    $valid_records[] = [
        'Name' => $name,
        'Email' => $email,
        'Age' => $age,
    ];
}

echo "<h2>Valid Student Records</h2>";
if (!empty($valid_records)) {
    echo "<table border='1' style='border-collapse: collapse; width: 600px;'>";
    echo "<tr><th>Name</th><th>Email</th><th>Age</th></tr>";

    foreach ($valid_records as $record) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($record['Name']) . "</td>";
        echo "<td>" . htmlspecialchars($record['Email']) . "</td>";
        echo "<td>" . htmlspecialchars($record['Age']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No valid records to display.</p>";
}

if (!empty($error_logs)) {
    $current_time = date('Y-m-d H:i:s');
    $log_content = "--- ERRORS LOGGED: $current_time ---\n" . implode("\n", $error_logs) . "\n\n";

    if (file_put_contents($error_log_file, $log_content, FILE_APPEND | LOCK_EX) !== false) {
        echo "<p style='color: orange;'>**" . count($error_logs) . "** invalid records found and logged to **$error_log_file**.</p>";
    } else {
        echo "<p style='color: red;'>Error: Could not write to error log file **$error_log_file**.</p>";
    }
}
?>
