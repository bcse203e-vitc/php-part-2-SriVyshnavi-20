<?php
$students = ["Rahul"=>85, "Priya"=>92, "Arun"=>78, "Meena"=>88, "Vikram"=>95];
arsort($students);

echo "<table border='1'><tr><th>Name</th><th>Marks</th></tr>";
$count = 0;
foreach($students as $name=>$marks){
    if($count++ == 3) break;
    echo "<tr><td>$name</td><td>$marks</td></tr>";
}
echo "</table>";
?>


