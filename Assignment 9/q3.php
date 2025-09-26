<?php

$emailAddresses = [
    "john@example.com",
    "wrong-email@",
    "me@site",
    "user123@gmail.com",
    "info.test@sub.domain.co.in",
    "no-domain"
];

$emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

echo "<h2>Valid Email Addresses (using Regex)</h2>";
echo "<ul>";

foreach ($emailAddresses as $email) {
    if (preg_match($emailRegex, $email)) {
        echo "<li>✅ " . htmlspecialchars($email) . "</li>";
    }
}

echo "</ul>";

?>
