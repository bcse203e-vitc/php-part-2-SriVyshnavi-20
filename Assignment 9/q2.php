<?php
$filename = 'products.txt';
$products = [];

if (file_exists($filename)) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Split the line into product name and price
        $parts = explode(',', $line);
        if (count($parts) === 2) {
            $name = trim($parts[0]);
            $price = (float)trim($parts[1]);
            $products[$name] = $price;
        }
    }

    asort($products);

    echo "<h2>Product List Sorted by Price</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 400px;'>";
    echo "<tr><th>Product Name</th><th>Price</th></tr>";

    foreach ($products as $name => $price) {
        // Format price with local currency (optional)
        $formatted_price = number_format($price, 2);
        echo "<tr><td>" . htmlspecialchars($name) . "</td><td>₹" . htmlspecialchars($formatted_price) . "</td></tr>";
    }

    echo "</table>";

} else {
    echo "<p style='color: red;'>Error: The file **$filename** was not found.</p>";
}
?>
