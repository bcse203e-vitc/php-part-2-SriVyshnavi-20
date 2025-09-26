<?php
date_default_timezone_set('Asia/Kolkata');
$current_datetime = date('d-m-Y H:i:s');
echo "<h2>Current Date and Time</h2>";
echo "<p>Current Time: **$current_datetime**</p>";
$dob_input = '2005-11-12'; 

echo "<h2>Days Until Next Birthday</h2>";
echo "<p>Date of Birth: **$dob_input**</p>";

try {
    $now = new DateTime();
    $dob = new DateTime($dob_input);
    $birth_month_day = $dob->format('m-d');
    $next_bday_year = $now->format('Y');
    $next_bday = DateTime::createFromFormat('Y-m-d', $next_bday_year . '-' . $birth_month_day);
    if ($next_bday < $now) {
        $next_bday->modify('+1 year');
    }
    $interval = $now->diff($next_bday);
    $days_left = $interval->days;

    echo "<p>Next Birthday is on: **" . $next_bday->format('d-m-Y') . "**</p>";
    echo "<p>Days left until next birthday: **$days_left** days.</p>";

} catch (Exception $e) {
    echo "<p style='color: red;'>Error calculating date: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
