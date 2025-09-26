<?php

class PasswordValidationException extends Exception {}

function validatePassword(string $password) {
    if (strlen($password) < 8) {
        throw new PasswordValidationException("Password must be at least 8 characters long.");
    }

    if (!preg_match('/[A-Z]/', $password)) {
        throw new PasswordValidationException("Password must contain at least one uppercase letter.");
    }

    if (!preg_match('/[0-9]/', $password)) {
        throw new PasswordValidationException("Password must contain at least one digit (0-9).");
    }

    if (!preg_match('/[@#$%^&+=!*]/', $password)) {
        throw new PasswordValidationException("Password must contain at least one special character (@#$%^&+=!*).");
    }

    return true;
}

$passwordsToTest = [
    "Testpass123!",
    "short!A1",
    "testpass123!",
    "TestpassXX!",
    "Testpass123",
];

echo "<h2>Password Validation with Error Handling</h2>";

foreach ($passwordsToTest as $password) {
    echo "Testing Password: <strong>" . htmlspecialchars($password) . "</strong><br>";
    try {
        validatePassword($password);
        echo "<p style='color: green;'>✅ Password is Valid!</p>";
    } catch (PasswordValidationException $e) {
        echo "<p style='color: red;'>❌ Validation Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    echo "<hr>";
}
?>
