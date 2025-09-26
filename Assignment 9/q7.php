<?php

function calculateAverage(array $numbers): float {
    if (empty($numbers)) {
        throw new Exception("No numbers provided");
    }

    $sum = array_sum($numbers);
    $count = count($numbers);

    return $sum / $count;
}

$numbers1 = [10, 20, 30, 40, 50];
echo "<h2>Average of Numbers with Error Handling</h2>";

echo "Array 1: [" . implode(', ', $numbers1) . "]<br>";
try {
    $average1 = calculateAverage($numbers1);
    echo "<p style='color: green;'>Average: <strong>" . number_format($average1, 2) . "</strong></p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}



$numbers2 = [];
echo "Array 2: []<br>";
try {
    $average2 = calculateAverage($numbers2);
    echo "<p style='color: green;'>Average: <strong>" . number_format($average2, 2) . "</strong></p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

?>
