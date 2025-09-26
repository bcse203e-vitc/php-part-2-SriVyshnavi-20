<?php
$inputFile = __DIR__ . "/data.txt"; 
$outputFile = __DIR__ . "/numbers.txt"; 

if (!file_exists($inputFile)) {
    die("Error: data.txt not found in this folder.");
}

$content = file_get_contents($inputFile);
preg_match_all("/\b\d{10}\b/", $content, $matches);

if (!empty($matches[0])) {
    file_put_contents($outputFile, implode("\n", $matches[0]));
    echo "Extracted numbers saved to numbers.txt<br>";
    echo "Numbers found:<br>";
    foreach ($matches[0] as $num) {
        echo $num . "<br>";
    }
} else {
    echo " No valid 10-digit numbers found in file.";
}
?>

