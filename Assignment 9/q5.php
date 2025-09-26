<?php
$log_file = 'access.log';
$username = 'test_user';
$action = 'Attempted Access'; // Example action
$timestamp = date('Y-m-d H:i:s');
$log_entry = "$username - $timestamp - $action\n";
if (file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX) !== false) {
    echo "<p style='color: blue;'>Log entry successfully written to **$log_file**.</p>";
} else {
    echo "<p style='color: red;'>Error writing to log file.</p>";
}
if (file_exists($log_file)) {
    $all_logs = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($all_logs) {
     
        $last_five_logs = array_slice($all_logs, -5);

        echo "<h2>Last 5 Log Entries</h2>";
        echo "<pre>"; // Use <pre> to maintain log format
        foreach ($last_five_logs as $log) {
            echo htmlspecialchars($log) . "\n";
        }
        echo "</pre>";
    } else {
        echo "<p>Log file is empty.</p>";
    }
}
?>
